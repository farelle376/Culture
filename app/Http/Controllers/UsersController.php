<?php

namespace App\Http\Controllers;

use App\Models\Type_contenu;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contenu;
use App\Models\Commentaire;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Afficher le tableau de bord utilisateur
     */
    /**
 * Obtenir les statistiques de l'utilisateur
 */   
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
    if (!$user) {
        return null;
    }

    return [
        'totalContenus' => Contenu::where('auteur_id', $user->id)->count(),
        'contenusApprouves' => Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->count(),
        'contenusEnAttente' => Contenu::where('auteur_id', $user->id)
            ->where('statut', 'pending')
            ->count(),
        'contenusRejetes' => Contenu::where('auteur_id', $user->id)
            ->where('statut', 'rejected')
            ->count(),
        'totalVues' => Contenu::where('auteur_id', $user->id)->sum('vues'),
        'totalLikes' => Contenu::where('auteur_id', $user->id)->sum('likes_count'),
        'totalCommentaires' => Contenu::where('auteur_id', $user->id)->sum('commentaires_count'),
    ];
}
    public function index(Request $request)
{
    // Initialiser les variables avec des valeurs par défaut
    $regions = Region::all();
    $langues = Langue::all();
    $typesContenu = Type_contenu::all();
    
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('front.inscrit');
    }

    // Requête de base pour les contenus approuvés (tous les contenus)
    $query = Contenu::where('statut', 'approved')
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

    // Filtrage par catégorie (si vous avez cette méthode)
    if ($filters['category'] && method_exists($this, 'applyCategoryFilter')) {
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

    // Statistiques de l'utilisateur
    $userStats = $this->getUserStats($user);
    
    // Contenus de l'utilisateur pour le dashboard
    $contenusUtilisateur = Contenu::where('auteur_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10, ['*'], 'user_page');

    $contenusEnAttente = Contenu::where('auteur_id', $user->id)
        ->where('statut', 'pending')
        ->count();

    $contenusPublies = Contenu::where('auteur_id', $user->id)
        ->where('statut', 'approved')
        ->count();

    $contenusRejetes = Contenu::where('auteur_id', $user->id)
        ->where('statut', 'rejected')
        ->count();

    $commentairesCount = $this->getCommentCount($user);
    $points = $this->calculerPointsUtilisateur($user);
    $statistiques = $this->getStatistiquesEngagement($user);
    $aucunContenu = $contenusUtilisateur->isEmpty();
    $derniersCommentaires = $this->getDerniersCommentaires($user->id);
    $hasContent = Contenu::where('auteur_id', $user->id)->exists();

    return view('front.users', [
        'contenus' => $contenus, // Tous les contenus approuvés
        'contenusUtilisateur' => $contenusUtilisateur, // Contenus de l'utilisateur
        'regions' => $regions,
        'langues' => $langues,
        'typesContenu' => $typesContenu,
        'filters' => $filters,
        'stats' => $stats,
        'user' => $user,
        'userStats' => $userStats,
        'activeCategory' => $filters['category'] ?? null,
        // Statistiques de l'utilisateur
        'contenusEnAttente' => $contenusEnAttente,
        'contenusPublies' => $contenusPublies,
        'contenusRejetes' => $contenusRejetes,
        'commentairesCount' => $commentairesCount,
        'points' => $points,
        'aucunContenu' => $aucunContenu,
        'statistiques' => $statistiques,
        'derniersCommentaires' => $derniersCommentaires,
        'hasContent' => $hasContent,
    ]);
}

    /**
     * Dashboard avec statistiques rapides
     */
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('front.inscrit');
        }

        // Statistiques rapides pour le dashboard
        $statsRapides = [
            'contenusTotal' => Contenu::where('auteur_id', $user->id)->count(),
            'contenusApprouves' => Contenu::where('auteur_id', $user->id)
                ->where('statut', 'approved')
                ->count(),
            'vuesTotal' => Contenu::where('auteur_id', $user->id)->sum('vues'),
            'likesTotal' => Contenu::where('auteur_id', $user->id)->sum('likes_count'),
        ];

        // Derniers contenus publiés
        $derniersContenus = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Contenus les plus populaires
        $contenusPopulaires = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->orderBy('vues', 'desc')
            ->orderBy('likes_count', 'desc')
            ->limit(5)
            ->get();

        return view('front.users-dashboard', [
            'user' => $user,
            'statsRapides' => $statsRapides,
            'derniersContenus' => $derniersContenus,
            'contenusPopulaires' => $contenusPopulaires,
        ]);
    }

    /**
     * Afficher tous les contenus de l'utilisateur
     */
    public function mesContenus()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('front.inscrit');
        }

        $filtre = request()->get('filtre', 'all');
        
        $query = Contenu::where('auteur_id', $user->id);

        // Appliquer le filtre
        if ($filtre === 'pending') {
            $query->where('statut', 'pending');
        } elseif ($filtre === 'approved') {
            $query->where('statut', 'approved');
        } elseif ($filtre === 'rejected') {
            $query->where('statut', 'rejected');
        }

        $contenus = $query->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('front.users-contenus', [
            'user' => $user,
            'contenus' => $contenus,
            'filtreActif' => $filtre,
        ]);
    }

    /**
     * Afficher les statistiques détaillées
     */
    public function statistiques()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('front.inscrit');
        }

        // Statistiques détaillées
        $statistiques = $this->getStatistiquesDetaillees($user);

        // Évolution des contenus sur les 6 derniers mois
        $evolutionContenus = $this->getEvolutionContenus($user);

        // Top 10 des contenus les plus populaires
        $topContenus = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->selectRaw('id, titre, vues, likes_count, 
                        (vues + (likes_count * 5) + (commentaires_count * 3)) as score')
            ->orderBy('score', 'desc')
            ->limit(10)
            ->get();

        // Répartition par type de contenu
        $repartitionType = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get()
            ->pluck('count', 'type');

        // Répartition par région
        $repartitionRegion = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->selectRaw('region, COUNT(*) as count')
            ->groupBy('region')
            ->get()
            ->pluck('count', 'region');

        return view('front.users-statistiques', [
            'user' => $user,
            'statistiques' => $statistiques,
            'evolutionContenus' => $evolutionContenus,
            'topContenus' => $topContenus,
            'repartitionType' => $repartitionType,
            'repartitionRegion' => $repartitionRegion,
        ]);
    }

    /**
     * Afficher le formulaire d'ajout de contenu
     */
    public function ajouterContenus()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('front.inscrit');
        }

        return view('front.users-ajouter-contenu', [
            'user' => $user,
        ]);
    }

    /**
     * Afficher le formulaire d'édition de contenu
     */
    public function editerContenu($id)
    {
        $user = Auth::user();
        $contenu = Contenu::where('id', $id)
            ->where('auteur_id', $user->id)
            ->firstOrFail();

        // Vérifier si le contenu peut être édité (seulement en attente ou rejeté)
        if ($contenu->statut === 'approved') {
            return redirect()->route('users.mes-contenus')
                ->with('warning', 'Ce contenu est déjà publié et ne peut plus être modifié.');
        }

        return view('front.users-editer-contenu', [
            'user' => $user,
            'contenu' => $contenu,
        ]);
    }

    /**
     * Supprimer un contenu
     */
    public function supprimerContenu($id)
    {
        $user = Auth::user();
        $contenu = Contenu::where('id', $id)
            ->where('auteur_id', $user->id)
            ->firstOrFail();

        // Vérifier si le contenu peut être supprimé
        if ($contenu->statut === 'approved') {
            return redirect()->route('users.mes-contenus')
                ->with('error', 'Ce contenu est publié et ne peut pas être supprimé. Contactez l\'administrateur.');
        }

        $contenu->delete();

        return redirect()->route('mes-contenus')
            ->with('success', 'Contenu supprimé avec succès.');
    }

    /**
     * Voir un contenu spécifique
     */
    public function voirContenu($id)
    {
        $user = Auth::user();
        $contenu = Contenu::where('id', $id)
            ->where('auteur_id', $user->id)
            ->firstOrFail();

        // Récupérer les commentaires avec pagination
        $commentaires = $contenu->commentaires()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Récupérer les statistiques d'engagement pour ce contenu
        $statistiquesContenu = [
            'likes' => $contenu->likes_count,
            'commentaires' => $contenu->commentaires_count,
            'vues' => $contenu->vues,
            'partages' => $contenu->partages_count,
            'score' => $contenu->vues + ($contenu->likes_count * 5) + ($contenu->commentaires_count * 3),
        ];

        return view('front.users-voir-contenu', [
            'user' => $user,
            'contenu' => $contenu,
            'commentaires' => $commentaires,
            'statistiquesContenu' => $statistiquesContenu,
        ]);
    }

    /**
     * Calculer les points de l'utilisateur
     */
    private function calculerPointsUtilisateur($user)
    {
        $points = 0;

        // Points pour les contenus publiés
        $points += Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->count() * 50;

        // Points pour les commentaires
        $commentCount = $this->getCommentCount($user);
        $points += $commentCount * 5;

        // Points bonus pour les contenus populaires
        $points += Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->where('likes_count', '>', 10)
            ->count() * 25;

        // Points bonus pour les contenus très populaires
        $points += Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->where('likes_count', '>', 50)
            ->count() * 100;

        // Points pour l'ancienneté (50 points par mois)
        $anciennete = now()->diffInMonths($user->created_at);
        $points += $anciennete * 50;

        return $points;
    }

    /**
     * Obtenir les statistiques d'engagement
     */
    private function getStatistiquesEngagement($user)
    {
        return [
            'total_vues' => Contenu::where('auteur_id', $user->id)->sum('vues'),
            'total_likes' => Contenu::where('auteur_id', $user->id)->sum('likes_count'),
            'total_commentaires' => $this->getCommentCount($user),
            'total_partages' => Contenu::where('auteur_id', $user->id)->sum('partages_count'),
            'taux_engagement' => $this->calculerTauxEngagement($user),
        ];
    }

    /**
     * Calculer le taux d'engagement
     */
    private function calculerTauxEngagement($user)
    {
        $totalContenus = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->count();

        if ($totalContenus === 0) {
            return 0;
        }

        $totalInteractions = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->sum('likes_count') +
            Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->sum('commentaires_count');

        return round(($totalInteractions / $totalContenus) * 100, 2);
    }

    /**
     * Obtenir les derniers commentaires
     */
    private function getDerniersCommentaires($userId)
    {
        try {
            // Essayer auteur_id d'abord, puis d'autres possibilités
            $query = Commentaire::query();
            
            if (\Schema::hasColumn('commentaires', 'auteur_id')) {
                $query->orWhere('auteur_id', $userId);
            }
            
            if (\Schema::hasColumn('commentaires', 'user_id')) {
                $query->orWhere('user_id', $userId);
            }
            
            if (\Schema::hasColumn('commentaires', 'utilisateur_id')) {
                $query->orWhere('utilisateur_id', $userId);
            }
            
            // Ajouter aussi les commentaires sur les contenus de l'utilisateur
            $query->orWhereHas('contenu', function($q) use ($userId) {
                $q->where('auteur_id', $userId);
            });
            
            return $query->with('contenu')
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
                
        } catch (\Exception $e) {
            // Si erreur, retourner juste ceux liés aux contenus
            return Commentaire::whereHas('contenu', function($query) use ($userId) {
                $query->where('auteur_id', $userId);
            })
            ->with('contenu')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        }
    }

    /**
     * Obtenir le nombre de commentaires
     */
    private function getCommentCount($user)
    {
        try {
            // Essayer différentes colonnes
            if (\Schema::hasColumn('commentaires', 'auteur_id')) {
                return Commentaire::where('auteur_id', $user->id)->count();
            }
            
            if (\Schema::hasColumn('commentaires', 'user_id')) {
                return Commentaire::where('user_id', $user->id)->count();
            }
            
            if (\Schema::hasColumn('commentaires', 'utilisateur_id')) {
                return Commentaire::where('utilisateur_id', $user->id)->count();
            }
            
            // Fallback: chercher les commentaires sur les contenus de l'utilisateur
            return Commentaire::whereHas('contenu', function($query) use ($user) {
                $query->where('auteur_id', $user->id);
            })->count();
            
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Obtenir les statistiques détaillées
     */
    private function getStatistiquesDetaillees($user)
    {
        return [
            'contenus' => [
                'total' => Contenu::where('auteur_id', $user->id)->count(),
                'approuves' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->count(),
                'en_attente' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'pending')
                    ->count(),
                'rejetes' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'rejected')
                    ->count(),
            ],
            'engagement' => [
                'vues_moyennes' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->avg('vues') ?? 0,
                'likes_moyens' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->avg('likes_count') ?? 0,
                'commentaires_moyens' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->avg('commentaires_count') ?? 0,
            ],
            'performances' => [
                'meilleur_contenu' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->orderBy('vues', 'desc')
                    ->first(),
                'plus_aimé' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->orderBy('likes_count', 'desc')
                    ->first(),
                'plus_commenté' => Contenu::where('auteur_id', $user->id)
                    ->where('statut', 'approved')
                    ->orderBy('commentaires_count', 'desc')
                    ->first(),
            ],
        ];
    }

    /**
     * Obtenir l'évolution des contenus sur 6 mois
     */
    private function getEvolutionContenus($user)
    {
        $evolution = [];
        $maintenant = now();

        for ($i = 5; $i >= 0; $i--) {
            $date = $maintenant->copy()->subMonths($i);
            $mois = $date->format('Y-m');
            $moisLabel = $date->translatedFormat('F Y');

            $contenusMois = Contenu::where('auteur_id', $user->id)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $evolution[$moisLabel] = $contenusMois;
        }

        return $evolution;
    }

    /**
     * API pour obtenir les statistiques en JSON
     */
    public function apiStatistiques()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        $contenusPublies = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'approved')
            ->count();

        $contenusEnAttente = Contenu::where('auteur_id', $user->id)
            ->where('statut', 'pending')
            ->count();

        $commentairesCount = $this->getCommentCount($user);
        $points = $this->calculerPointsUtilisateur($user);

        return response()->json([
            'success' => true,
            'data' => [
                'published' => $contenusPublies,
                'pending' => $contenusEnAttente,
                'comments' => $commentairesCount,
                'points' => $points,
                'hasContent' => $contenusPublies > 0,
                'engagement' => $this->getStatistiquesEngagement($user),
            ],
        ]);
    }

    /**
     * API pour obtenir les contenus de l'utilisateur
     */
    public function apiContenus()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Non authentifié'], 401);
        }

        $contenus = Contenu::where('auteur_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $contenus,
        ]);
    }

    /**
     * Vérifier la structure pour debug
     */
    public function debug()
    {
        $user = Auth::user();
        
        if (!$user) {
            return "Non connecté";
        }
        
        $output = "<h1>Debug - Colonne trouvée : auteur_id</h1>";
        $output .= "<p>User ID: {$user->id}</p>";
        
        // Test avec auteur_id
        try {
            $count = Contenu::where('auteur_id', $user->id)->count();
            $output .= "<p style='color:green'>✓ Requête réussie avec 'auteur_id': {$count} contenus</p>";
            
            if ($count > 0) {
                $contenus = Contenu::where('auteur_id', $user->id)->limit(3)->get();
                $output .= "<h3>Exemples de contenus :</h3>";
                foreach ($contenus as $contenu) {
                    $output .= "<p>- {$contenu->titre} (Statut: {$contenu->statut})</p>";
                }
            }
        } catch (\Exception $e) {
            $output .= "<p style='color:red'>✗ Erreur: " . $e->getMessage() . "</p>";
        }
        
        return $output;
    }






    public function ajouterContenu()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('front.inscrit');
        }

        // Récupérer les données pour les dropdowns
        $typesContenu = Type_contenu::orderBy('nom')->get();
        $regions = Region::orderBy('nom_region')->get();
        $langues = Langue::orderBy('nom_langue')->get();
        
        // Récupérer les modérateurs (utilisateurs avec rôle modérateur)
        $moderateurs = Utilisateur::whereHas('role', function($query) {
            $query->where('id_role', 'moderateur');
        })->orderBy('id_role')->get();

        return view('front.users-ajouter-contenu', [
            'user' => $user,
            'typesContenu' => $typesContenu,
            'regions' => $regions,
            'langues' => $langues,
            'moderateurs' => $moderateurs,
        ]);
    }

    public function storeContenu(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('front.inscrit');
        }

        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'id_type_contenu' => 'required|exists:type_contenu,id',
            'texte' => 'required|string|min:10',
            'id_region' => 'required|exists:region,id',
            'id_langue' => 'required|exists:langue,id',
            'id_moderateur' => 'nullable|exists:utilisateur,id',
            'date_creation' => 'nullable|date',
            'parent_id' => 'nullable|exists:contenu,id',
            'vues' => 'nullable|integer|min:0',
            'likes_count' => 'nullable|integer|min:0',
            'commentaires_count' => 'nullable|integer|min:0',
            'partages_count' => 'nullable|integer|min:0',
        ]);

        // Créer le contenu
        $contenu = new Contenu();
        $contenu->titre = $validated['titre'];
        $contenu->id_type_contenu = $validated['id_type_contenu'];
        $contenu->texte = $validated['texte'];
        $contenu->auteur_id = $user->id; // L'auteur est l'utilisateur connecté
        $contenu->id_region = $validated['id_region'];
        $contenu->id_langue = $validated['id_langue'];
        
        // Définir la date de création si fournie, sinon maintenant
        $contenu->date_creation = $validated['date_creation'] ?? now();
        
        // Statut par défaut
        $contenu->statut = 'pending';
        
        // Modérateur (peut être null)
        if (!empty($validated['id_moderateur'])) {
            $contenu->id_moderateur = $validated['id_moderateur'];
        }
        
        // Parent ID (pour les réponses)
        if (!empty($validated['parent_id'])) {
            $contenu->parent_id = $validated['parent_id'];
        }
        
        // Statistiques (valeurs par défaut)
        $contenu->vues = $validated['vues'] ?? 0;
        $contenu->likes_count = $validated['likes_count'] ?? 0;
        $contenu->commentaires_count = $validated['commentaires_count'] ?? 0;
        $contenu->partages_count = $validated['partages_count'] ?? 0;
        
        $contenu->save();

        // Redirection avec message de succès
        return redirect()->route('users.mes-contenus')
            ->with('success', 'Votre contenu a été soumis avec succès et est en attente de validation.');
    }

    // Méthode pour récupérer le contenu parent (si nécessaire)
    public function getParentContenus()
    {
        $contenus = Contenu::where('statut', 'approved')
            ->with(['auteur', 'typeContenu'])
            ->orderBy('titre')
            ->get()
            ->map(function($contenu) {
                return [
                    'id' => $contenu->id,
                    'texte' => $contenu->titre . ' - ' . 
                              ($contenu->auteur->name ?? 'Auteur inconnu') . ' - ' . 
                              ($contenu->typeContenu->nom ?? '')
                ];
            });
            
        return response()->json($contenus);
    }
    // Dans UsersController.php
// Dans UsersController.php
public function mesContenu()
{
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('front.inscrit');
    }

    $filtre = request()->get('filtre', 'all');
    
    $query = Contenu::where('auteur_id', $user->id)
        ->with(['typeContenu', 'region', 'langue', 'user']);

    // Appliquer le filtre
    if ($filtre === 'pending') {
        $query->where('statut', 'pending');
    } elseif ($filtre === 'approved') {
        $query->where('statut', 'approved');
    } elseif ($filtre === 'rejected') {
        $query->where('statut', 'rejected');
    } elseif ($filtre === 'draft') {
        $query->where('statut', 'draft');
    }

    $contenus = $query->orderBy('created_at', 'desc')
        ->paginate(12);

    // Statistiques
    $stats = [
        'total' => Contenu::where('auteur_id', $user->id)->count(),
        'approved' => Contenu::where('auteur_id', $user->id)->where('statut', 'approved')->count(),
        'pending' => Contenu::where('auteur_id', $user->id)->where('statut', 'pending')->count(),
        'rejected' => Contenu::where('auteur_id', $user->id)->where('statut', 'rejected')->count(),
    ];

    return view('front.users-contenus', [
        'user' => $user,
        'contenus' => $contenus,
        'filtreActif' => $filtre,
        'stats' => $stats,
    ]);
}
}
