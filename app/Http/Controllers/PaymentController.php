<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Services\FedapayService;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $fedapayService;
    
    public function __construct(FedapayService $fedapayService)
    {
        $this->fedapayService = $fedapayService;
    }
    
    /**
     * Afficher le formulaire de paiement
     */
    public function showPaymentForm($orderId)
    {
        $order = Order::where('id', $orderId)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();
        
        return view('payment.form', compact('order'));
    }
    
    /**
     * Initialiser le paiement
     */
    public function initiatePayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);
        
        $order = Order::where('id', $request->order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        if ($order->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Cette commande a déjà été traitée.');
        }
        
        // Préparer les données pour Fedapay
        $transactionData = [
            'amount' => $order->total,
            'currency' => 'XOF',
            'description' => 'Paiement commande #' . $order->id,
            'callback_url' => route('payment.callback'),
            'customer' => [
                'firstname' => Auth::user()->first_name,
                'lastname' => Auth::user()->last_name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ],
            'metadata' => [
                'order_id' => $order->id,
                'user_id' => Auth::id(),
            ]
        ];
        
        // Créer la transaction chez Fedapay
        $fedapayResponse = $this->fedapayService->createTransaction($transactionData);
        
        if (!$fedapayResponse || !isset($fedapayResponse['transaction']['url'])) {
            Log::error('Échec création transaction Fedapay', [
                'order_id' => $order->id,
                'response' => $fedapayResponse
            ]);
            
            return redirect()->back()
                ->with('error', 'Erreur lors de la création du paiement. Veuillez réessayer.');
        }
        
        // Enregistrer le paiement en base de données
        $payment = Payment::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'fedapay_transaction_id' => $fedapayResponse['transaction']['id'],
            'amount' => $order->total,
            'status' => 'pending',
            'payment_url' => $fedapayResponse['transaction']['url'],
            'metadata' => json_encode($fedapayResponse),
        ]);
        
        // Rediriger vers la page de paiement Fedapay
        return redirect()->away($fedapayResponse['transaction']['url']);
    }
    
    /**
     * Callback après paiement
     */
    public function callback(Request $request)
    {
        $transactionId = $request->query('transaction_id');
        
        if (!$transactionId) {
            return redirect()->route('home')
                ->with('error', 'Transaction ID manquant.');
        }
        
        // Récupérer le paiement
        $payment = Payment::where('fedapay_transaction_id', $transactionId)
            ->first();
        
        if (!$payment) {
            return redirect()->route('home')
                ->with('error', 'Paiement non trouvé.');
        }
        
        // Vérifier le statut chez Fedapay
        $isVerified = $this->fedapayService->verifyTransaction($transactionId);
        
        if ($isVerified) {
            // Mettre à jour le paiement
            $payment->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);
            
            // Mettre à jour la commande
            $payment->order->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
            
            return redirect()->route('orders.show', $payment->order_id)
                ->with('success', 'Paiement effectué avec succès !');
        }
        
        // Paiement échoué
        $payment->update(['status' => 'failed']);
        
        return redirect()->route('orders.show', $payment->order_id)
            ->with('error', 'Le paiement a échoué. Veuillez réessayer.');
    }
    
    /**
     * Webhook Fedapay
     */
    public function webhook(Request $request)
    {
        Log::info('Fedapay Webhook Received', $request->all());
        
        // Vérifier la signature (optionnel)
        $signature = $request->header('X-Fedapay-Signature');
        $payload = $request->getContent();
        
        $event = $request->input('event');
        $data = $request->input('data');
        
        if (!$event || !$data) {
            Log::error('Webhook Fedapay invalide', $request->all());
            return response()->json(['error' => 'Données invalides'], 400);
        }
        
        // Traiter l'événement
        $transactionId = $data['id'] ?? null;
        
        if (!$transactionId) {
            Log::error('Transaction ID manquant dans le webhook', $data);
            return response()->json(['error' => 'Transaction ID manquant'], 400);
        }
        
        // Trouver le paiement
        $payment = Payment::where('fedapay_transaction_id', $transactionId)->first();
        
        if (!$payment) {
            Log::warning('Paiement non trouvé pour le webhook', ['transaction_id' => $transactionId]);
            return response()->json(['error' => 'Paiement non trouvé'], 404);
        }
        
        // Traiter selon l'événement
        switch ($event) {
            case 'transaction.approved':
            case 'transaction.success':
                $payment->update(['status' => 'completed']);
                $payment->order->update(['status' => 'paid']);
                Log::info('Paiement approuvé via webhook', ['payment_id' => $payment->id]);
                break;
                
            case 'transaction.canceled':
                $payment->update(['status' => 'canceled']);
                Log::info('Paiement annulé via webhook', ['payment_id' => $payment->id]);
                break;
                
            case 'transaction.declined':
            case 'transaction.failed':
                $payment->update(['status' => 'failed']);
                Log::info('Paiement échoué via webhook', ['payment_id' => $payment->id]);
                break;
                
            default:
                Log::warning('Événement Fedapay non géré', ['event' => $event]);
        }
        
        return response()->json(['status' => 'success'], 200);
    }
    
    /**
     * Tester la connexion API
     */
    public function testConnection()
    {
        $result = $this->fedapayService->testConnection();
        
        return response()->json($result);
    }
}