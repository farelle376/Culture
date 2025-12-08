@extends('layout1')
@section('content')
@section('css')
<style>
/* Overlay sombre */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(2px);
    z-index: 999;
}

/* Boîte modale */
.modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.8);
    background: #fff;
    width: 70%;
    max-height: 90vh;
    overflow-y: auto;
    border-radius: 12px;
    padding: 20px;
    z-index: 1000;
    opacity: 0;
    transition: 0.3s ease;
}

/* Affichage actif */
.modal.active,
.modal-overlay.active {
    display: block;
}

.modal.active {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
}

/* Bouton X */
.close-modal {
    position: absolute;
    right: 15px;
    top: 10px;
    border: none;
    background: transparent;
    font-size: 2rem;
    cursor: pointer;
}
/* ====== Container principal ====== */
.profile-container {
    max-width: 450px;
    margin: 40px auto;
    padding: 25px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    font-family: "Poppins", sans-serif;
}

/* ====== Titre ====== */
.profile-container h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 1.4rem;
    font-weight: 600;
}

/* ====== Groupes de champs ====== */
.form-group {
    margin-bottom: 15px;
}

/* ====== Labels ====== */
.form-group label {
    display: block;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 6px;
    color: #333;
}

/* ====== Inputs ====== */
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 0.95rem;
    outline: none;
    transition: 0.2s;
}

/* Effet focus */
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #4A8DF3;
    box-shadow: 0 0 3px rgba(74,141,243,0.5);
}

/* ====== Bouton ====== */
.btn-submit {
    width: 100%;
    background: #4A8DF3;
    color: white;
    padding: 12px;
    font-size: 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.btn-submit:hover {
    background: #3575d9;
}
/* Section Statistiques Utilisateur */
.user-stats {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-blue) 100%);
    color: white;
    padding: 3rem 2rem;
    border-radius: 15px;
    margin: 2rem auto;
    max-width: 1200px;
    box-shadow: 0 10px 30px rgba(0, 132, 80, 0.2);
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-yellow), var(--primary-orange));
}

.stat-number {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    color: var(--primary-yellow);
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

.stat-card div:last-child {
    font-size: 1rem;
    opacity: 0.9;
    letter-spacing: 0.5px;
}

/* Message aucun contenu */
.no-content-message {
    background: white;
    border-radius: 15px;
    padding: 3rem 2rem;
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.message-icon {
    font-size: 4rem;
    color: var(--primary-green);
    margin-bottom: 1.5rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.no-content-message h3 {
    color: var(--dark-brown);
    margin-bottom: 1rem;
    font-size: 1.8rem;
}

.no-content-message p {
    color: var(--dark-gray);
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

#startCreatingBtn {
    padding: 1rem 2.5rem;
    font-size: 1.1rem;
    border-radius: 30px;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

/* Animation pour les statistiques */
@keyframes countUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.stat-card {
    animation: countUp 0.6s ease forwards;
    animation-delay: calc(var(--delay, 0) * 0.1s);
    opacity: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-container {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .stat-number {
        font-size: 2.5rem;
    }
    
    .user-stats {
        padding: 2rem 1rem;
        margin: 1rem;
    }
}

@media (max-width: 480px) {
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}

/* Nouveaux styles pour les filtres dynamiques */
    .advanced-filters {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin: 30px auto;
        max-width: 1200px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 15px;
    }

    .filter-group {
        margin-bottom: 0;
    }

    .filter-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #333;
    }

    .filter-group select,
    .filter-group input {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 10px;
    }

    /* Badge pour les contenus de l'utilisateur */
    .my-content-badge {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
        margin-left: 5px;
    }

    /* Statistiques globales */
    .global-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin: 20px 0;
    }

    .global-stat-card {
        background: white;
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .global-stat-number {
        font-size: 1.8rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 5px;
    }

    .global-stat-label {
        font-size: 0.8rem;
        color: #666;
    }
    .my-content-badge {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
        margin-left: 5px;
    }
      /* Modal Abonnement */
#subscriptionModal {
    display: none; /* Caché par défaut */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5); /* Fond sombre transparent */
    z-index: 1000;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease-in-out;
}

#subscriptionModal .modal-content {
    background: white;
    border-radius: 10px;
    padding: 2rem;
    width: 90%;
    max-width: 500px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    position: relative;
    animation: slideIn 0.3s ease-in-out;
}

#subscriptionModal .modal-content h2 {
    color: var(--primary-color);
    margin-bottom: 1rem;
}

#subscriptionModal .modal-content p {
    margin-bottom: 2rem;
    font-size: 1rem;
    color: #555;
}

#subscriptionModal .modal-content .btn {
    margin: 0.5rem;
}

/* Close button */
#subscriptionModal .close {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
    color: #333;
    transition: color 0.3s;
}

#subscriptionModal .close:hover {
    color: var(--accent-color);
}

/* Animations */
@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

@keyframes slideIn {
    from {transform: translateY(-50px); opacity: 0;}
    to {transform: translateY(0); opacity: 1;}
}

/* Responsive */
@media (max-width: 768px) {
    #subscriptionModal .modal-content {
        padding: 1.5rem;
        width: 95%;
    }
}
</style>
@endsection

@section('content')
    <section class="hero" id="accueil">
        <div class="hero-video-container">
            <video autoplay muted loop playsinline class="hero-video">
                <source src="{{ URL::asset('adminlte/img/video3.mp4') }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <br><br><br><br><br><br><br>
                <h2>Découvrez la richesse culturelle du Bénin</h2>
                <p>Explorez, commentez et créez du contenu pour enrichir notre patrimoine culturel commun.</p>
                @auth
                    <a href="{{ route('ajouter-contenu') }}">
                        <button class="btn btn-primary">
                            <span>Créer un nouveau contenu</span>
                        </button>
                    </a>
                @else
                    <a href="{{ route('front.inscrit') }}">
                        <button class="btn btn-primary">
                            <span>Connectez-vous pour contribuer</span>
                        </button>
                    </a>
                @endauth
            </div>
        </div>
    </section>
 <section class="featured" id="contenus">
        <h2 class="section-title">Contenus Culturels</h2>
        <div class="content-grid">

            <!-- HISTOIRE 1 -->
            <div class="content-card" data-category="histoires">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img13.jpeg') }}');"></div>
    <div class="content-body">
        <h3>La Légende de Dakodonou</h3>
        <div class="content-meta">
            <span>Région: Zou</span>
            <div class="content-language">Fon</div>
        </div>
        <p class="content-description">
            L'histoire du roi fon Dakodonou, symbole de courage et de sagesse.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="La Légende de Dakodonou"
                data-description="Un récit ancien sur le roi Dakodonou et les valeurs de bravoure."
                data-region="Zou"
                data-langue="Fon"
                data-media="<img src='{{ URL::asset('adminlte/img/img11.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire  ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>

            <!-- RECETTE 1 -->
            <div class="content-card" data-category="savois">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img14.jpeg') }}');"></div>
    <div class="content-body">
        <h3>Les Masques Guèlèdè</h3>
        <div class="content-meta">
            <span>Région: Collines</span>
            <div class="content-language">Yoruba</div>
        </div>
        <p class="content-description">
            Un aperçu des masques guèlèdè et de leur importance dans la société.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="Les Masques Guèlèdè"
                data-description="Découverte de l'art et de la signification des masques guèlèdè."
                data-region="Collines"
                data-langue="Yoruba"
                data-media="<img src='{{ URL::asset('adminlte/img/img12.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>

             <div class="content-card" data-category="histoires">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img15.jpeg') }}');"></div>
    <div class="content-body">
        <h3>La Panthère de Savalou</h3>
        <div class="content-meta">
            <span>Région: Collines</span>
            <div class="content-language">Idaasha</div>
        </div>
        <p class="content-description">
            Une légende impressionnante sur l'esprit protecteur de Savalou.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="La Panthère de Savalou"
                data-description="Une légende fascinante sur la panthère mystique de Savalou."
                data-region="Collines"
                data-langue="Idaasha"
                data-media="<img src='{{ URL::asset('adminlte/img/img13.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>

 <div class="content-card" data-category="recette">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img16.jpeg') }}');"></div>
    <div class="content-body">
        <h3>Le Wassawassa du Nord</h3>
        <div class="content-meta">
            <span>Région: Atacora</span>
            <div class="content-language">Dendi</div>
        </div>
        <p class="content-description">
            Un plat traditionnel préparé à base de cossettes de manioc.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="Le Wassawassa du Nord"
                data-description="Découverte d’un plat emblématique du nord du Bénin."
                data-region="Atacora"
                data-langue="Dendi"
                data-media="<img src='{{ URL::asset('adminlte/img/img14.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>

 <div class="content-card" data-category="savoir">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img17.jpeg') }}');"></div>
    <div class="content-body">
        <h3>Le Culte Vodoun Zangbéto</h3>
        <div class="content-meta">
            <span>Région: Ouémé</span>
            <div class="content-language">Goun</div>
        </div>
        <p class="content-description">
            Les hommes de nuit protecteurs des communautés Goun.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="Le Culte Vodoun Zangbéto"
                data-description="Un regard profond sur les Zangbéto et leur rôle protecteur."
                data-region="Ouémé"
                data-langue="Goun"
                data-media="<img src='{{ URL::asset('adminlte/img/img15.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>
<div class="content-card" data-category="savoirs">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img18.jpeg') }}');"></div>
    <div class="content-body">
        <h3>Bio Guéra le Résistant</h3>
        <div class="content-meta">
            <span>Région: Borgou</span>
            <div class="content-language">Bariba</div>
        </div>
        <p class="content-description">
            Un héros national ayant combattu la colonisation française.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="Bio Guéra le Résistant"
                data-description="Une biographie résumée du roi Bio Guéra."
                data-region="Borgou"
                data-langue="Bariba"
                data-media="<img src='{{ URL::asset('adminlte/img/img16.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>
<div class="content-card" data-category="article">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img19.jpeg') }}');"></div>
    <div class="content-body">
        <h3>Les Rythmes Tchingounmè</h3>
        <div class="content-meta">
            <span>Région: Mono</span>
            <div class="content-language">Sahouè</div>
        </div>
        <p class="content-description">
            Un rythme traditionnel sahouè utilisé lors des cérémonies importantes.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="Les Rythmes Tchingounmè"
                data-description="Un aperçu des rythmes Tchingounmè et de leur rôle culturel."
                data-region="Mono"
                data-langue="Sahouè"
                data-media="<img src='{{ URL::asset('adminlte/img/img17.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>
<div class="content-card" data-category="savoirs">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img31.jpeg') }}');"></div>
    <div class="content-body">
        <h3>La Porte du Non-Retour</h3>
        <div class="content-meta">
            <span>Région: Atlantique</span>
            <div class="content-language">Français</div>
        </div>
        <p class="content-description">
            Un site historique emblématique retraçant la mémoire de la traite négrière.
        </p>
        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="La Porte du Non-Retour"
                data-description="Découverte d’un lieu symbolique fort de l’histoire du Bénin."
                data-region="Atlantique"
                data-langue="Français"
                data-media="<img src='{{ URL::asset('adminlte/img/img18.jpg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚
            </button>
            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>



            <!-- ARTICLE 1 -->
          <div class="content-card" data-category="musique">
    <div class="content-img" style="background-image: url('{{ URL::asset('adminlte/img/img20.jpeg') }}');"></div>

    <div class="content-body">
        <h3>Le Chant des Batteurs Nagot</h3>

        <div class="content-meta">
            <span>Région: Collines</span>
            <div class="content-language">Nagot</div>
        </div>

        <p class="content-description">
            Une histoire captivante sur l'origine des rythmes sacrés nagot, transmis de génération en génération.
        </p>

        <div class="content-actions">
            <button class="btn btn-primary btn-sm btn-lecture"
                data-titre="Le Chant des Batteurs Nagot"
                data-description="Découvrez l'histoire des tambours sacrés nagot, un héritage musical ancestral toujours vivant dans les Collines."
                data-region="Collines"
                data-langue="Nagot"
                data-media="<img src='{{ URL::asset('adminlte/img/img13.jpeg') }}' style='width:100%; border-radius:10px;'>">
                Lire ✚ 
            </button>

            <button class="btn btn-outline btn-sm">Écouter</button>
            <button class="btn btn-secondary btn-sm">Traduire</button>
        </div>
    </div>
</div>

    </section>
    <!-- Statistiques utilisateur (si connecté) -->
    @auth
    <section class="user-stats" id="userStatsSection">
        @if(isset($userStats) && $userStats)
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-number" id="publishedCount">{{ $userStats['published'] ?? 0 }}</div>
                    <div>Contenus publiés</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="pendingCount">{{ $userStats['pending'] ?? 0 }}</div>
                    <div>En attente</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="commentsCount">{{ $userStats['comments'] ?? 0 }}</div>
                    <div>Commentaires</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number" id="pointsCount">{{ $userStats['points'] ?? 0 }}</div>
                    <div>Points</div>
                </div>
            </div>
            
            <!-- Message si aucun contenu -->
            @if(isset($hasContent) && $hasContent)
            <div class="no-content-message" id="noContentMessage">
                <div class="message-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>Aucun contenu créé</h3>
                <p>Commencez à partager votre culture avec la communauté</p>
                <a href="{{ route('ajouter-contenu') }}" class="btn btn-primary" id="startCreatingBtn">
                    <i class="fas fa-plus-circle"></i> Commencer à créer
                </a>
            </div>
            @endif
        @endif
    </section>
    @endauth

    <!-- Statistiques globales -->
    @if(isset($stats) && $stats)
    <div class="advanced-filters">
        <div class="global-stats">
            <div class="global-stat-card">
                <div class="global-stat-number">{{ $stats['totalContenus'] ?? 0 }}</div>
                <div class="global-stat-label">Contenus publiés</div>
            </div>
            <div class="global-stat-card">
                <div class="global-stat-number">{{ $stats['regionsCount'] ?? 0 }}</div>
                <div class="global-stat-label">Régions</div>
            </div>
            <div class="global-stat-card">
                <div class="global-stat-number">{{ $stats['languesCount'] ?? 0 }}</div>
                <div class="global-stat-label">Langues</div>
            </div>
            <div class="global-stat-card">
                <div class="global-stat-number">{{ $stats['typesCount'] ?? 0 }}</div>
                <div class="global-stat-label">Catégories</div>
            </div>
        </div>
    </div>
    @endif
    <!-- Filtres avancés -->
    <div class="advanced-filters">
        <form id="filterForm" method="GET" action="{{ route('front.users') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="region"><i class="fas fa-map-marker-alt"></i> Région</label>
                    <select id="region" name="region" class="form-select">
                        <option value="">Toutes les régions</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ (request('region') == $region->id) ? 'selected' : '' }}>
                                {{ $region->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="langue"><i class="fas fa-language"></i> Langue</label>
                    <select id="langue" name="langue" class="form-select">
                        <option value="">Toutes les langues</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue->id }}" {{ (request('langue') == $langue->id) ? 'selected' : '' }}>
                                {{ $langue->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="type"><i class="fas fa-tags"></i> Type de contenu</label>
                    <select id="type" name="type" class="form-select">
                        <option value="">Tous les types</option>
                        @foreach($typesContenu as $type)
                            <option value="{{ $type->id }}" {{ (request('type') == $type->id) ? 'selected' : '' }}>
                                {{ $type->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="search"><i class="fas fa-search"></i> Recherche</label>
                    <input type="text" id="search" name="search" class="form-control" 
                           placeholder="Rechercher..." value="{{ request('search') }}">
                </div>
            </div>
            
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-filter"></i> Appliquer les filtres
                </button>
                <a href="{{ route('home') }}" class="btn btn-outline btn-sm">
                    <i class="fas fa-times"></i> Effacer les filtres
                </a>
            </div>
        </form>
    </div>

    <!-- Categories Filter -->
    <section class="categories">
        <div class="categories-container">
            <h2 class="section-title">Explorer par catégorie</h2>
            <div class="categories-list">
                <a href="{{ route('home') }}" class="category-filter {{ !request('category') ? 'active' : '' }}">
                    Tous les contenus
                </a>
                <a href="{{ route('category', 'histoires') }}" class="category-filter {{ request('category') == 'histoires' ? 'active' : '' }}">
                    Histoires & Contes
                </a>
                <a href="{{ route('category', 'recettes') }}" class="category-filter {{ request('category') == 'recettes' ? 'active' : '' }}">
                    Recettes Culinaires
                </a>
                <a href="{{ route('category', 'articles') }}" class="category-filter {{ request('category') == 'articles' ? 'active' : '' }}">
                    Articles Culturels
                </a>
                @auth
                    <a href="{{ route('category', 'mes-contenus') }}" class="category-filter {{ request('category') == 'mes-contenus' ? 'active' : '' }}">
                        Mes contenus
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Featured Content -->
    <section class="featured" id="contenus">
        <h2 class="section-title">Contenus Culturels</h2>
        
        @if($contenus->count() > 0)
            <div class="content-grid">
                @foreach($contenus as $contenu)
                    <div class="content-card" data-category="{{ strtolower($contenu->typeContenu->nom ?? 'autre') }}">
                        <div class="content-img" 
                             style="background-image: url('{{ $contenu->image_url ?: asset('adminlte/img/img' . rand(10, 30) . '.jpeg') }}');">
                        </div>
                        
                        <div class="content-body">
                            <h3>{{ $contenu->titre }}</h3>

                            <div class="content-meta">
                                @if($contenu->region)
                                    <span>Région: {{ $contenu->region->nom }}</span>
                                @endif
                                
                                @if($contenu->langue)
                                    <div class="content-language">{{ $contenu->langue->nom }}</div>
                                @endif
                                
                                @auth
                                    @if($contenu->auteur_id == Auth::id())
                                        <span class="my-content-badge">Mon contenu</span>
                                    @endif
                                @endauth
                            </div>

                            <!-- Rating -->
                            <div class="rating">
                                <div class="stars">
                                    @php
                                        $rating = $contenu->rating ?? rand(30, 50) / 10;
                                        $fullStars = floor($rating);
                                    @endphp
                                    
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="star {{ $i <= $fullStars ? 'active' : '' }}">★</span>
                                    @endfor
                                </div>
                                <span class="rating-value">{{ number_format($rating, 1) }}</span>
                                <small class="text-muted">({{ $contenu->vues ?? 0 }} vues)</small>
                            </div>

                            <p class="content-description">
                                {{ Str::limit(strip_tags($contenu->texte), 120) }}
                            </p>

                            <div class="content-actions">
                                <a href="{{ route('show', $contenu->id) }}" class="btn btn-primary btn-sm">
                                    <span>Voir détails</span>
                                </a>
                                
                                @auth
                                    @if($contenu->auteur_id == Auth::id())
                                        <a href="{{ route('editer-contenu', $contenu->id) }}" class="btn btn-outline btn-sm">
                                            <span>Modifier</span>
                                        </a>
                                    @else
                                        <button class="btn btn-outline btn-sm" onclick="translateContent({{ $contenu->id }})">
                                            <span>Traduire</span>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($contenus->hasPages())
                <div class="pagination-container">
                    {{ $contenus->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Aucun contenu trouvé</h3>
                <p>
                    @if(request()->hasAny(['region', 'langue', 'type', 'search']))
                        Aucun contenu ne correspond à vos critères de recherche. Essayez d'autres filtres.
                    @else
                        Aucun contenu n'est disponible pour le moment. Soyez le premier à en créer un !
                    @endif
                </p>
                @auth
                    <a href="{{ route('ajouter-contenu') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Créer un contenu
                    </a>
                @else
                    <a href="{{ route('front.inscription') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Inscrivez-vous pour contribuer
                    </a>
                @endauth
            </div>
        @endif
    </section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des filtres
        const filterForm = document.getElementById('filterForm');
        const filterSelects = filterForm.querySelectorAll('select');
        
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                filterForm.submit();
            });
        });

        // Filtrage par catégorie
        const categoryFilters = document.querySelectorAll('.category-filter');
        categoryFilters.forEach(filter => {
            filter.addEventListener('click', function(e) {
                if (this.classList.contains('active')) {
                    e.preventDefault();
                }
            });
        });

        // Animation des statistiques
        @auth
            function animateStats() {
                const stats = {
                    published: {{ $userStats['published'] ?? 0 }},
                    pending: {{ $userStats['pending'] ?? 0 }},
                    comments: {{ $userStats['comments'] ?? 0 }},
                    points: {{ $userStats['points'] ?? 0 }}
                };

                Object.keys(stats).forEach((key, index) => {
                    const element = document.getElementById(key + 'Count');
                    if (element) {
                        animateCounter(element, stats[key]);
                    }
                });
            }

            function animateCounter(element, finalValue) {
                let current = 0;
                const increment = finalValue / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= finalValue) {
                        element.textContent = finalValue;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current);
                    }
                }, 20);
            }

            // Animer les stats au chargement
            setTimeout(animateStats, 500);
        @endauth

        // Gestion du formulaire de recherche
        const searchInput = document.getElementById('search');
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                filterForm.submit();
            }, 500);
        });

        // Fonction de traduction
        window.translateContent = function(contentId) {
            // Implémentez la logique de traduction ici
            alert('Fonction de traduction à implémenter pour le contenu #' + contentId);
        };
    });
</script>
@endsection