<?php
// app/Services/FedapayService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FedapayService
{
    private $baseUrl;
    private $secretKey;
    private $publicKey;
    private $token;
    
    public function __construct()
    {
        $mode = env('FEDAPAY_MODE', 'sandbox');
        
        if ($mode === 'production') {
            $this->baseUrl = 'https://api.fedapay.com/v1';
            $this->secretKey = env('FEDAPAY_SECRET_KEY_PROD');
            $this->publicKey = env('FEDAPAY_PUBLIC_KEY_PROD');
            $this->token = env('FEDAPAY_TOKEN_PROD');
        } else {
            $this->baseUrl = 'https://api.fedapay.com/sandbox/v1';
            $this->secretKey = env('FEDAPAY_SECRET_KEY');
            $this->publicKey = env('FEDAPAY_PUBLIC_KEY');
            $this->token = env('FEDAPAY_TOKEN');
        }
    }
    
    /**
     * Créer une transaction
     */
    public function createTransaction(array $data)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($this->baseUrl . '/transactions', [
                'amount' => $data['amount'] * 100, // Convertir en centimes
                'currency' => $data['currency'] ?? 'XOF',
                'description' => $data['description'] ?? 'Paiement',
                'callback_url' => $data['callback_url'] ?? route('payment.callback'),
                'customer' => [
                    'firstname' => $data['customer']['firstname'],
                    'lastname' => $data['customer']['lastname'],
                    'email' => $data['customer']['email'],
                    'phone_number' => $data['customer']['phone'] ?? null,
                ],
                'metadata' => $data['metadata'] ?? []
            ]);
            
            Log::info('Fedapay API Response', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Fedapay API Error', [
                'status' => $response->status(),
                'error' => $response->body()
            ]);
            
            return null;
            
        } catch (\Exception $e) {
            Log::error('Fedapay Service Error: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Récupérer une transaction
     */
    public function getTransaction($transactionId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Accept' => 'application/json',
            ])->get($this->baseUrl . '/transactions/' . $transactionId);
            
            return $response->successful() ? $response->json() : null;
            
        } catch (\Exception $e) {
            Log::error('Fedapay Get Transaction Error: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Vérifier le statut d'une transaction
     */
    public function verifyTransaction($transactionId)
    {
        $transaction = $this->getTransaction($transactionId);
        
        if (!$transaction || !isset($transaction['transaction'])) {
            return false;
        }
        
        $status = $transaction['transaction']['status'];
        
        return $status === 'approved' || $status === 'successful';
    }
    
    /**
     * Créer un client
     */
    public function createCustomer(array $customerData)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/customers', [
                'firstname' => $customerData['firstname'],
                'lastname' => $customerData['lastname'],
                'email' => $customerData['email'],
                'phone_number' => $customerData['phone'] ?? null,
            ]);
            
            return $response->successful() ? $response->json() : null;
            
        } catch (\Exception $e) {
            Log::error('Fedapay Create Customer Error: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Tester la connexion API
     */
    public function testConnection()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])->get($this->baseUrl . '/accounts/current');
            
            return [
                'connected' => $response->successful(),
                'status' => $response->status(),
                'data' => $response->successful() ? $response->json() : null
            ];
            
        } catch (\Exception $e) {
            return [
                'connected' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}