<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        // Récupérer toutes les régions avec pagination
        $regions = Region::orderBy('nom_region')->paginate(12);
        
        // Calculer les statistiques
        $stats = [
            'total_regions' => Region::count(),
            'total_population' => Region::sum('population'),
            'total_superficie' => Region::sum('superficie'),
            'population_moyenne' => Region::avg('population'),
            'superficie_moyenne' => Region::avg('superficie'),
        ];
        
        return view('front.region', compact('regions', 'stats'));
    }
    
    public function show($id)
    {
        $region = Region::findOrFail($id);
        return view('front.regionshow', compact('region'));
    }
}