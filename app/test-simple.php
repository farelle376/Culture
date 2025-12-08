<?php
// test-simple.php - Placez ce fichier à la racine

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;

require __DIR__.'/vendor/autoload.php';

$app = new Application(__DIR__);
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test direct
try {
    echo "=== Test des modèles ===\n\n";
    
    // Test Order
    echo "1. Test Order::class\n";
    $orderClassExists = class_exists(\App\Models\Order::class);
    echo $orderClassExists ? "✅ Classe Order existe\n" : "❌ Classe Order n'existe pas\n";
    
    if ($orderClassExists) {
        $orderNumber = \App\Models\Order::generateOrderNumber();
        echo "   Numéro généré: {$orderNumber}\n";
    }
    
    // Test Payment
    echo "\n2. Test Payment::class\n";
    $paymentClassExists = class_exists(\App\Models\Payment::class);
    echo $paymentClassExists ? "✅ Classe Payment existe\n" : "❌ Classe Payment n'existe pas\n";
    
    // Test User
    echo "\n3. Test User::class\n";
    $userClassExists = class_exists(\App\Models\User::class);
    echo $userClassExists ? "✅ Classe User existe\n" : "❌ Classe User n'existe pas\n";
    
    // Test DB connection
    echo "\n4. Test connexion DB\n";
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        echo "✅ Connexion DB réussie\n";
    } catch (Exception $e) {
        echo "❌ Erreur DB: " . $e->getMessage() . "\n";
    }
    
    // Création d'un utilisateur de test
    echo "\n5. Création utilisateur de test\n";
    if ($userClassExists) {
        $user = \App\Models\User::first();
        if ($user) {
            echo "   Utilisateur existant: {$user->email}\n";
            
            // Tester la création d'ordre
            if ($orderClassExists && $paymentClassExists) {
                echo "\n6. Test création Order et Payment\n";
                
                $order = \App\Models\Order::create([
                    'order_number' => \App\Models\Order::generateOrderNumber(),
                    'user_id' => $user->id,
                    'customer_email' => $user->email,
                    'customer_firstname' => 'Test',
                    'customer_lastname' => 'User',
                    'total' => 10000,
                    'status' => 'pending',
                    'items' => json_encode([['name' => 'Produit Test', 'price' => 10000]])
                ]);
                
                echo "   ✅ Order créé: #{$order->order_number}\n";
                
                $payment = \App\Models\Payment::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'fedapay_transaction_id' => 'txn_test_' . time(),
                    'amount' => $order->total,
                    'payment_url' => 'https://test.fedapay.com',
                    'status' => 'pending'
                ]);
                
                echo "   ✅ Payment créé: {$payment->fedapay_transaction_id}\n";
                
                // Test relations
                echo "\n7. Test relations\n";
                echo "   Order->payments count: " . $order->payments()->count() . "\n";
                echo "   Payment->order number: " . $payment->order->order_number . "\n";
            }
        } else {
            echo "   ❌ Aucun utilisateur trouvé\n";
            echo "   Créez d'abord un utilisateur via register ou artisan\n";
        }
    }
    
} catch (Exception $e) {
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
}