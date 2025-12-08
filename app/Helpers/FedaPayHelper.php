<?php

namespace App\Helpers;

use FedaPay\FedaPay;
use FedaPay\Transaction;
use FedaPay\Customer;
use Exception;

class FedaPayHelper
{
    /**
     * Initialiser FedaPay
     */
    public static function initialize()
    {
        $apiKey = config('fedapay.api_key');
        $environment = config('fedapay.environment', 'sandbox');
        
        if (!$apiKey) {
            throw new Exception('FedaPay API key is not configured');
        }
        
        FedaPay::setApiKey($apiKey);
        FedaPay::setEnvironment($environment);
    }

    /**
     * Créer une transaction
     */
    public static function createTransaction($data)
    {
        self::initialize();
        
        try {
            $transaction = Transaction::create($data);
            return $transaction;
        } catch (Exception $e) {
            throw new Exception('FedaPay transaction error: ' . $e->getMessage());
        }
    }

    /**
     * Créer un client
     */
    public static function createCustomer($data)
    {
        self::initialize();
        
        try {
            $customer = Customer::create($data);
            return $customer;
        } catch (Exception $e) {
            throw new Exception('FedaPay customer error: ' . $e->getMessage());
        }
    }

    /**
     * Récupérer une transaction
     */
    public static function getTransaction($id)
    {
        self::initialize();
        
        try {
            $transaction = Transaction::retrieve($id);
            return $transaction;
        } catch (Exception $e) {
            throw new Exception('FedaPay get transaction error: ' . $e->getMessage());
        }
    }

    /**
     * Générer un token de paiement
     */
    public static function generatePaymentToken($transactionId)
    {
        self::initialize();
        
        try {
            $transaction = Transaction::retrieve($transactionId);
            $token = $transaction->generateToken();
            return $token->token;
        } catch (Exception $e) {
            throw new Exception('FedaPay token generation error: ' . $e->getMessage());
        }
    }

    /**
     * Vérifier le statut d'une transaction
     */
    public static function checkTransactionStatus($transactionId)
    {
        self::initialize();
        
        try {
            $transaction = Transaction::retrieve($transactionId);
            return [
                'id' => $transaction->id,
                'status' => $transaction->status,
                'amount' => $transaction->amount,
                'currency' => $transaction->currency,
                'created_at' => $transaction->created_at,
            ];
        } catch (Exception $e) {
            throw new Exception('FedaPay status check error: ' . $e->getMessage());
        }
    }

    /**
     * Obtenir l'URL de paiement
     */
    public static function getPaymentUrl($token)
    {
        $environment = config('fedapay.environment', 'sandbox');
        
        if ($environment === 'sandbox') {
            return "https://sandbox.fedapay.com/pay/{$token}";
        }
        
        return "https://pay.fedapay.com/{$token}";
    }
}