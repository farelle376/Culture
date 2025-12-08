<?php

namespace App\Http\Controllers;

use App\Models\Type_contenu;
use Illuminate\Http\Request;
use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use App\Models\Commentaire;
use Illuminate\Support\Facades\Auth;

class HomesController extends Controller
{
    public function index(Request $request)
    {
        // Initialiser les variables avec des valeurs par défaut
        $regions = Region::all();
        $langues = Langue::all();
        $typesContenu = Type_contenu::all();
        
        // Requête de base pour les contenus approuvés
        $query = Contenu::where('status', 'approved')
            ->with(['region', 'langue', 'typeContenu', 'user'])
            ->orderBy('created_at', 'desc');

        // Filtres
        $filters = [
            'region' => $request->get('region'),
            'langue' => $request->get('langue'),
            'type' => $request->get('type'),
            'search' => $request->get('search'),
            'category' => $request->get('category')
        ];

        // Appliquer les filtres
        if ($filters['region']) {
            $query->where('id_region', $filters['region']);
        }

        if ($filters['langue']) {
            $query->where('id_langue', $filters['langue']);
        }

        if ($filters['type']) {
            $query->where('id_typeContenu', $filters['type']);
        }

        if ($filters['search']) {
            $query->where(function($q) use ($filters) {
                $q->where('titre', 'LIKE', '%' . $filters['search'] . '%')
                  ->orWhere('texte', 'LIKE', '%' . $filters['search'] . '%');
            });
        }

        // Filtrage par catégorie
        if ($filters['category']) {
            $query = $this->applyCategoryFilter($query, $filters['category']);
        }

        $contenus = $query->paginate(12);

        // Statistiques globales
        $stats = [
            'totalContenus' => Contenu::where('statut', 'approved')->count(),
            'regionsCount' => $regions->count(),
            'languesCount' => $langues->count(),
            'typesCount' => $typesContenu->count(),
        ];

        // Récupérer l'utilisateur connecté pour afficher ses statistiques
        $user = Auth::user();
        $userStats = null;
        
        if ($user) {
            $userStats = $this->getUserStats($user);
        }

        return view('front.users', [
            'contenus' => $contenus,
            'regions' => $regions,
            'langues' => $langues,
            'typesContenu' => $typesContenu,
            'filters' => $filters,
            'stats' => $stats,
            'user' => $user,
            'userStats' => $userStats,
            'activeCategory' => $filters['category'] ?? null
        ]);
    }

    private function applyCategoryFilter($query, $category)
    {
        switch ($category) {
            case 'histoires':
                return $query->whereHas('typeContenu', function($q) {
                    $q->where('nom', 'LIKE', '%histoire%')
                      ->orWhere('nom', 'LIKE', '%conte%');
                });
            case 'recettes':
                return $query->whereHas('typeContenu', function($q) {
                    $q->where('nom', 'LIKE', '%recette%')
                      ->orWhere('nom', 'LIKE', '%cuisine%');
                });
            case 'articles':
                return $query->whereHas('typeContenu', function($q) {
                    $q->where('nom', 'LIKE', '%article%')
                      ->orWhere('nom', 'LIKE', '%culture%');
                });
            case 'mes-contenus':
                if (Auth::check()) {
                    return $query->where('auteur_id', Auth::id());
                }
                break;
        }
        
        return $query;
    }

    private function getUserStats($user)
    {
        try {
            return [
                'published' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->count(),
                'pending' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'pending')
                    ->count(),
                'comments' => Commentaire::where('id_auteur', $user->id)->count(),
                'points' => $this->calculateUserPoints($user),
                'hasContent' => Contenu::where('auteur_id', $user->id)->exists(),
            ];
        } catch (\Exception $e) {
            // En cas d'erreur, retourner des valeurs par défaut
            return [
                'published' => 0,
                'pending' => 0,
                'comments' => 0,
                'points' => 0,
                'hasContent' => false,
            ];
        }
    }

    private function calculateUserPoints($user)
    {
        try {
            $points = 0;

            // Points pour les contenus publiés
            $points += Contenu::where('auteur_id', $user->id)
                ->where('statut', 'approved')
                ->count() * 50;

            // Points pour les commentaires
            $points += Commentaire::where('id_auteur', $user->id)->count() * 5;

            // Points pour l'ancienneté
            $anciennete = now()->diffInMonths($user->created_at);
            $points += $anciennete * 50;

            return $points;
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function show($id)
    {
        $contenu = Contenu::where('statut', 'approved')
            ->with(['region', 'langue', 'typeContenu', 'user', 'commentaires.user'])
            ->findOrFail($id);

        // Incrémenter les vues
        $contenu->increment('vues');

        return view('front.contenu-detail', compact('contenu'));
    }

    public function filterByCategory(Request $request, $category)
    {
        // Utiliser la même méthode que index() mais avec une catégorie spécifique
        $request->merge(['category' => $category]);
        return $this->index($request);
    }
}