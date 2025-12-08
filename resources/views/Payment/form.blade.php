{{-- resources/views/payment/form.blade.php --}}
@extends('layout1')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Paiement de la commande #{{ $order->id }}</h4>
                </div>
                
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Récapitulatif</h5>
                        <ul class="list-unstyled">
                            <li><strong>Total à payer:</strong> {{ number_format($order->total, 0, ',', ' ') }} FCFA</li>
                            <li><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
                        </ul>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        Vous allez être redirigé vers la plateforme sécurisée Fedapay pour finaliser votre paiement.
                    </div>
                    
                    <form action="{{ route('payment.initiate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-lock"></i> Payer avec Fedapay
                            </button>
                            
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Retour à la commande
                            </a>
                        </div>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <img src="https://fedapay.com/images/logo.svg" alt="Fedapay" height="40" class="mb-2">
                        <p class="text-muted small">
                            Paiement sécurisé par Fedapay
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection