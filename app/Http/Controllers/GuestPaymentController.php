<?php
// app/Http/Controllers/GuestPaymentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use App\Models\GuestPayment;

class GuestPaymentController extends Controller
{
    // Page de sélection d'abonnement pour visiteurs
    public function showPlans()
    {
        $plans = [
            [
                'id' => 1,
                'name' => 'Abonnement Mensuel',
                'price' => 5000,
                'features' => ['Accès 30 jours', 'Contenu premium', 'Sans publicité']
            ],
            [
                'id' => 2,
                'name' => 'Abonnement Annuel',
                'price' => 50000,
                'features' => ['Accès 1 an', 'Contenu premium', 'Sans publicité', '-17% économisé']
            ]
        ];
        
        return view('guest.subscription', compact('plans'));
    }
    
    // Formulaire de paiement pour visiteur
    public function showPaymentForm(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer',
        ]);
        
        $planId = $request->plan_id;
        $plans = [
            1 => ['name' => 'Mensuel', 'price' => 5000],
            2 => ['name' => 'Annuel', 'price' => 50000],
        ];
        
        if (!isset($plans[$planId])) {
            return redirect()->route('guest.plans')->with('error', 'Plan invalide');
        }
        
        $plan = $plans[$planId];
        
        return view('guest.payment-form', compact('plan'));
    }
    
    // Traiter le paiement
    public function processPayment(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|integer',
            'email' => 'required|email',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string',
            'amount' => 'required|numeric',
        ]);
        
        // Clés FedaPay
        $apiKey = config('fedapay.secret_key');
        $isSandbox = config('fedapay.mode') === 'sandbox';
        $baseUrl = $isSandbox 
            ? 'https://sandbox-api.fedapay.com/v1/' 
            : 'https://api.fedapay.com/v1/';
        
        try {
            // 1. Créer la transaction FedaPay
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->post($baseUrl . 'transactions', [
                'description' => 'Abonnement ' . $request->input('plan_name', 'Premium'),
                'amount' => (int) $request->amount,
                'currency' => ['iso' => 'XOF'],
                'callback_url' => route('guest.payment.callback'),
                'cancel_url' => route('guest.payment.cancel'),
                'customer' => [
                    'firstname' => $request->prenom,
                    'lastname' => $request->nom,
                    'email' => $request->email,
                    'phone_number' => [
                        'number' => $request->telephone,
                        'country' => 'bj'
                    ]
                ],
                'metadata' => [
                    'plan_id' => $request->plan_id,
                    'client_email' => $request->email,
                    'client_phone' => $request->telephone,
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $transactionId = $data['id'];
                
                // 2. Sauvegarder en session pour retrouver après paiement
                session([
                    'guest_payment' => [
                        'transaction_id' => $transactionId,
                        'email' => $request->email,
                        'nom' => $request->nom,
                        'prenom' => $request->prenom,
                        'telephone' => $request->telephone,
                        'plan_id' => $request->plan_id,
                        'amount' => $request->amount,
                    ]
                ]);
                
                // 3. Sauvegarder dans la base (optionnel)
                GuestPayment::create([
                    'transaction_id' => $transactionId,
                    'email' => $request->email,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'telephone' => $request->telephone,
                    'amount' => $request->amount,
                    'plan_id' => $request->plan_id,
                    'status' => 'pending',
                    'metadata' => json_encode($data),
                ]);
                
                // 4. Rediriger vers FedaPay
                $paymentUrl = "https://" . ($isSandbox ? 'sandbox-' : '') 
                            . "checkout.fedapay.com/" . $transactionId;
                
                return redirect($paymentUrl);
                
            } else {
                $error = $response->json();
                return back()->withInput()->with('error', 
                    'Erreur FedaPay: ' . ($error['message'] ?? 'Erreur inconnue'));
            }
            
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 
                'Erreur de connexion: ' . $e->getMessage());
        }
    }
    
    // Callback après paiement réussi
    public function handleCallback(Request $request)
    {
        $transactionId = $request->input('id');
        
        if (!$transactionId) {
            return redirect()->route('guest.plans')->with('error', 'Transaction non trouvée');
        }
        
        // Récupérer des sessions ou de la base
        $paymentData = session('guest_payment');
        
        if (!$paymentData) {
            // Chercher dans la base
            $payment = GuestPayment::where('transaction_id', $transactionId)->first();
            if ($payment) {
                $paymentData = $payment->toArray();
            }
        }
        
        // Vérifier le statut chez FedaPay
        $apiKey = config('fedapay.secret_key');
        $isSandbox = config('fedapay.mode') === 'sandbox';
        $baseUrl = $isSandbox 
            ? 'https://sandbox-api.fedapay.com/v1/' 
            : 'https://api.fedapay.com/v1/';
        
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
            ])->get($baseUrl . 'transactions/' . $transactionId);
            
            if ($response->successful()) {
                $data = $response->json();
                $status = $data['status']; // 'approved', 'declined', 'canceled'
                
                // Mettre à jour dans la base
                $payment = GuestPayment::where('transaction_id', $transactionId)->first();
                if ($payment) {
                    $payment->update([
                        'status' => $status,
                        'paid_at' => now(),
                        'metadata' => json_encode($data),
                    ]);
                }
                
                if ($status === 'approved') {
                    // Générer un code d'accès unique
                    $accessCode = strtoupper(substr(md5(uniqid()), 0, 12));
                    
                    // Sauvegarder le code d'accès
                    if ($payment) {
                        $payment->update(['access_code' => $accessCode]);
                    }
                    
                    // Envoyer un email avec le code d'accès
                    if (isset($paymentData['email'])) {
                        \Mail::to($paymentData['email'])->send(
                            new \App\Mail\SubscriptionConfirmation($accessCode, $paymentData)
                        );
                    }
                    
                    // Page de succès avec le code
                    return view('guest.payment-success', [
                        'access_code' => $accessCode,
                        'email' => $paymentData['email'] ?? '',
                        'plan' => $paymentData['plan_id'] ?? 1,
                    ]);
                    
                } else {
                    return view('guest.payment-failed', [
                        'status' => $status,
                        'transaction_id' => $transactionId,
                    ]);
                }
            }
            
        } catch (\Exception $e) {
            // En cas d'erreur
            return view('guest.payment-pending', [
                'transaction_id' => $transactionId,
                'message' => 'Vérification en cours...',
            ]);
        }
        
        return redirect()->route('guest.plans')->with('warning', 'Paiement en attente');
    }
    
    // Page d'annulation
    public function handleCancel(Request $request)
    {
        $transactionId = $request->input('id');
        
        if ($transactionId) {
            GuestPayment::where('transaction_id', $transactionId)
                ->update(['status' => 'canceled']);
        }
        
        return view('guest.payment-canceled', [
            'transaction_id' => $transactionId,
        ]);
    }
    
    // Vérifier un code d'accès
    public function checkAccess(Request $request)
    {
        $request->validate([
            'access_code' => 'required|string|size:12',
        ]);
        
        $payment = GuestPayment::where('access_code', strtoupper($request->access_code))
            ->where('status', 'approved')
            ->where('valid_until', '>', now())
            ->first();
        
        if ($payment) {
            // Créer une session temporaire pour l'accès
            session(['guest_access' => [
                'payment_id' => $payment->id,
                'valid_until' => now()->addHours(24),
            ]]);
            
            return redirect()->route('guest.content')->with('success', 'Accès autorisé!');
        }
        
        return back()->with('error', 'Code invalide ou expiré');
    }
}