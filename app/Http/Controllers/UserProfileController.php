<?php

namespace App\Http\Controllers;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
     public function index()
    {
        $user = Auth::user();
        
        // Si ce n'est pas une instance de Utilisateur, le chercher
        if (!$user instanceof Utilisateur) {
            $user = Utilisateur::find(Auth::id());
        }
        
        // Charger la relation langue
        $user->load('langue');
        
        // Calculer les statistiques SIMPLES sans contenus sauvegardés
        $contenusCount = $user->contenus()->count();
    return view('front.userprofile', compact('user', 'contenusCount'));
}
public function edit()
{
    $user = auth()->user();
    return view('front.modifierprofile', compact('user'));
}


public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validation simple
        $request->validate([
            'prenom' => 'required|string|max:50',
            'nom' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:utilisateurs,email,' . $user->id,
            'sexe' => 'nullable|in:homme,femme,autre',
            'date_naissance' => 'nullable|date|before:today',
        ], [
            'prenom.required' => 'Le prénom est obligatoire',
            'nom.required' => 'Le nom est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'Email invalide',
            'email.unique' => 'Cet email est déjà utilisé',
            'date_naissance.date' => 'Date invalide',
            'date_naissance.before' => 'La date doit être dans le passé',
        ]);

        try {
            // Mettre à jour uniquement les champs modifiables
            $user->update([
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'email' => $request->email,
                'sexe' => $request->sexe,
                'date_naissance' => $request->date_naissance,
            ]);

            return redirect()->route('profile')
                ->with('success', 'Profil mis à jour avec succès!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Afficher la page du profil
     */
    


    }
   

