<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LangueController extends Controller
{
    public function index()
    {
        // Récupérer toutes les langues avec pagination
        $langues = Langue::orderBy('nom_langue')->paginate(12);
        
        // Statistiques simples
        $stats = [
            'total_langues' => Langue::count(),
        ];
        
        return view('front.langue', compact('langues', 'stats'));
    }
    
    public function show($id)
    {
        $langue = Langue::findOrFail($id);
        
        // Compter le nombre d'utilisateurs qui parlent cette langue
        $nombre_utilisateurs = $langue->utilisateurs()->count();
        
        return view('front.langueshow', compact('langue', 'nombre_utilisateurs'));
    }
}