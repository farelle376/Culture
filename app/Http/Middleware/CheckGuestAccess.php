<?php
// app/Http/Middleware/CheckGuestAccess.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckGuestAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Routes accessibles sans abonnement
        $publicRoutes = ['guest.plans', 'guest.payment.*', 'guest.check.access'];
        
        if ($request->routeIs($publicRoutes)) {
            return $next($request);
        }
        
        // Vérifier l'accès dans la session
        if (session('guest_access')) {
            $access = session('guest_access');
            
            // Vérifier la validité
            if (isset($access['valid_until']) && now()->lt($access['valid_until'])) {
                return $next($request);
            }
            
            // Session expirée
            session()->forget('guest_access');
        }
        
        // Rediriger vers la page d'abonnement
        return redirect()->route('guest.plans')
            ->with('error', 'Accès réservé aux abonnés. Veuillez vous abonner.');
    }
}