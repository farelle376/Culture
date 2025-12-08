<?php
// config/fedapay.php
return [
    'mode' => env('FEDAPAY_MODE', 'sandbox'),
    
    'sandbox' => [
        'secret_key' => env('FEDAPAY_SECRET_KEY'),
        'public_key' => env('FEDAPAY_PUBLIC_KEY'),
        'token' => env('FEDAPAY_TOKEN'),
    ],
    
    'production' => [
        'secret_key' => env('FEDAPAY_SECRET_KEY_PROD'),
        'public_key' => env('FEDAPAY_PUBLIC_KEY_PROD'),
        'token' => env('FEDAPAY_TOKEN_PROD'),
    ],
    
    'currency' => 'XOF',
    'webhook_secret' => env('FEDAPAY_WEBHOOK_SECRET'),
    
    'routes' => [
        'success' => 'payment/success',
        'cancel' => 'payment/cancel',
        'callback' => 'payment/callback',
        'webhook' => 'api/fedapay/webhook',
    ],
];