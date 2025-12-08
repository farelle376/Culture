<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use FedaPay\FedaPay;

class FedaPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge configuration
        $this->mergeConfigFrom(
            __DIR__.'/../../config/fedapay.php',
            'fedapay'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Initialiser FedaPay
        $this->initializeFedaPay();
        
        // Publier la configuration si nécessaire
        $this->publishes([
            __DIR__.'/../../config/fedapay.php' => config_path('fedapay.php'),
        ], 'fedapay-config');
    }

    /**
     * Initialiser FedaPay avec les paramètres de configuration
     */
    protected function initializeFedaPay(): void
    {
        $apiKey = config('fedapay.api_key');
        $environment = config('fedapay.environment', 'sandbox');

        if ($apiKey) {
            FedaPay::setApiKey($apiKey);
            FedaPay::setEnvironment($environment);
        }
    }
}