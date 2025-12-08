<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InscritController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function create(): View
    {
        return view('front.inscrit'); // ta vue login
    }

    /**
     * Gère la connexion de l'utilisateur
     */
    public function connection(Request $request): RedirectResponse
    {
        // Validation des champs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Tentative d'authentification
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // sécurité session
            return redirect()->intended(route('front.users')); // page personnelle
        }

        // Si échec
        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logoute(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('front.front'); // redirection après logout
    }
}
