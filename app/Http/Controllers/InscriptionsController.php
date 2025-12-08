<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use App\Models\Langue;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscriptionsController extends Controller
{
     public function showRegisterForm()
    {
        // Récupérer la liste des langues depuis la BD
        $utilisateurs = Utilisateur::all();
        $langues= Langue::all();
        return view('front.inscription', compact('langues'));
    }
     public function index()
    {
        // Récupérer la liste des langues depuis la BD
       
        return view('front.front');
    }
     public function propos()
    {
        // Récupérer la liste des langues depuis la BD
       
        return view('front.apropos');
    }
    public function inscrits()
    {
        // Récupérer la liste des langues depuis la BD
       
        return view('front.inscrit');
    }
    public function utilisateur()
    {
        // Récupérer la liste des langues depuis la BD
       
        return view('front.users');
    }

    // Enregistrement de l'utilisateur
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:utilisateur,email',
            'date_naissance' => 'required|date',
            'sexe' => 'required|string',
            'password' => 'required|min:6',
            'id_langue' => 'required|exists:langue,id',
        ]);

          $user=Utilisateur::create($request->all());
         
        return view('front.users');
        
    }
}
