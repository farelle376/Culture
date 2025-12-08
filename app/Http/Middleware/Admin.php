<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
{
    // Vérifie si l'utilisateur n'est pas connecté OU n'est pas admin
    if (!Auth::check() || !Auth::user()->isAdmin()) {

        // Redirection vers une page (ex: home) avec un message
        return redirect()->route('users')->with('error', "Vous n'avez pas accès à cette zone !");
    }

    return $next($request);
}

}
