    @extends('layouts')
    @section('content')
    @section('css')
    <style>
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
    <section class="hero" id="accueil">
        <div class="video-background">
            <video autoplay muted loop playsinline>
                <source src="{{ URL::asset('adminlte/img/videos.mp4') }}" type="video/mp4">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80">
            </video>
            <div class="video-overlay"></div>
        </div>
        
        <div class="hero-content">
            <h2>Découvrez la richesse culturelle du Bénin</h2>
            <p>Plongez au cœur des traditions, contes, recettes et langues qui font la diversité exceptionnelle de notre patrimoine culturel.</p>
            <div class="hero-buttons">
                <a href="{{route('front.inscription') }}"><button class="btn btn-primary" >Rejoindre la communauté</button></a>
                <button class="btn btn-outline" onclick="scrollToSection('contenus')">Explorer les contenus</button>
            </div>
        </div>
    </section>

    <!-- Categories Filter -->
    <section class="categories">
        <div class="categories-container">
            <h2 class="section-title">Explorer par catégorie</h2>
            <div class="categories-list">
                <div class="category-filter active" data-category="all">Tous les contenus</div>
                <div class="category-filter" data-category="histoires">Histoires & Contes</div>
                <div class="category-filter" data-category="recettes">Recettes Culinaires</div>
                <div class="category-filter" data-category="articles">Articles Culturels</div>
                <div class="category-filter" data-category="savoirs">Savoirs & Traditions</div>
            </div>
        </div>
    </section>

    <!-- Featured Content -->
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

    <!-- Regions Section -->
    <section class="regions" id="regions">
        <div class="regions-container">
            <h2 class="section-title">Régions du Bénin</h2>
            <div class="regions-grid">
                <div class="region-card"><h3>Atacora</h3><p>Langues principales: Dendi, Waama</p></div>
                <div class="region-card"><h3>Zou</h3><p>Langues principales: Fon, Goun</p></div>
                <div class="region-card"><h3>Mono</h3><p>Langues principales: Fon, Goun</p></div>
                <div class="region-card"><h3>Collines</h3><p>Langues principales: Yoruba, Ifè</p></div>
                <div class="region-card"><h3>Donga</h3><p>Langues principales: Yom</p></div>
                <div class="region-card"><h3>Borgou</h3><p>Langues principales: Bariba, Cabe</p></div>
            </div>
        </div>
    </section>

    <!-- Languages -->
    <section class="languages" id="langues">
        <div class="languages-container">
            <h2 class="section-title">Langues Nationales</h2>
            <p>Notre plateforme valorise toutes les langues du Bénin.</p>
            <div class="languages-list">
                <div class="language-tag">Fon</div>
                <div class="language-tag">Yoruba</div>
                <div class="language-tag">Dendi</div>
                <div class="language-tag">Goun</div>
                <div class="language-tag">Bariba</div>
                <div class="language-tag">Adja</div>
                <div class="language-tag">Waama</div>
                <div class="language-tag">Yom</div>
            </div>
        </div>
    </section>
    <!-- CTA -->
    <section class="cta">
        <div class="cta-content">
            <h2>Devenez contributeur</h2>
            <p>Partagez vos connaissances avec la communauté.</p>
            <a href="{{route('front.inscription') }}"><button class="btn btn-accent">Commencer</button></a>
        </div>
    </section>
    <!-- Bouton pour déclencher le modal -->


<!-- JavaScript -->

    @endsection