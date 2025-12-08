<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Bénin - Découvrez notre riche patrimoine</title>
    <link rel="stylesheet" href="{{ URL::asset('adminlte/css1/layout2.css') }}" />
    @yield('css')
</head>
<body>

    <!-- Header -->
    <header id="mainHeader">
        <div class="header-container">
            <div class="logo">
                <img src="{{ URL::asset('adminlte/img/img8.png') }}" alt="Logo Culture Bénin">
                <a href="{{route('front.front') }}"><h1>Culture Bénin</h1></a>
            </div>
            <nav>
                <ul>
                    <li><a href="#contenus">Contenus</a></li>
                    <li><a href="#regions">Régions</a></li>
                    <li><a href="#langues">Langues</a></li>
                    <li><a href="{{route('front.apropos') }}">À propos</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                <a href="{{route('front.inscrit') }}"><button class="btn btn-outline" >Connexion</button></a>
                <a href="{{route('front.inscription') }}"><button class="btn btn-primary">S'inscrire</button></a>
            </div>
        </div>
    </header>

    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Culture Bénin</h3>
                <p>Plateforme numérique pour la promotion de la culture et des langues du Bénin.</p>
            </div>
            <div class="footer-section">
                <h3>Liens rapides</h3>
                <ul>
                    <li><a href="#accueil">Accueil</a></li>
                    <li><a href="#contenus">Contenus</a></li>
                    <li><a href="#regions">Régions</a></li>
                    <li><a href="#creation">Créer</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <ul>
                    <li>Email: contact@culturebenin.bj</li>
                    <li>Téléphone: +229 XX XX XX XX</li>
                    <li>Adresse: Cotonou, Bénin</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p><a href="{{ route('login') }}">&copy;</a> 2023 Plateforme Culturelle du Bénin. Tous droits réservés.</p>
        </div>
    </footer>


   
    </div>
@yield('script')
    <!-- Scripts -->
    <script>

        /* ------------------------------
           MODAL AFFICHAGE CONTENU
        ------------------------------ */
        const contenuModal = document.getElementById('contenuModal');
        const modalTitre = document.getElementById('modalTitre');
        const modalDescription = document.getElementById('modalDescription');
        const modalRegion = document.getElementById('modalRegion');
        const modalLangue = document.getElementById('modalLangue');
        const modalMedia = document.getElementById('modalMedia');

        document.querySelectorAll('.btn-lecture').forEach(btn => {
            btn.addEventListener('click', function () {
                modalTitre.innerText = this.dataset.titre;
                modalDescription.innerText = this.dataset.description;
                modalRegion.innerText = this.dataset.region;
                modalLangue.innerText = this.dataset.langue;
                modalMedia.innerHTML = this.dataset.media;

                contenuModal.style.display = "flex";
            });
        });

        function closeContenuModal() {
            contenuModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === contenuModal) {
                closeContenuModal();
            }
        }

        /* ------------------------------ 
           Login / Register 
        ------------------------------ */
        function openLoginModal(){ document.getElementById('loginModal').style.display='flex'; }
        function closeLoginModal(){ document.getElementById('loginModal').style.display='none'; }
        function openRegisterModal(){ document.getElementById('registerModal').style.display='flex'; }
        function closeRegisterModal(){ document.getElementById('registerModal').style.display='none'; }

        /* Category Filter */
        document.querySelectorAll('.category-filter').forEach(filter => {
            filter.addEventListener('click', function() {
                document.querySelectorAll('.category-filter').forEach(f => f.classList.remove('active'));
                this.classList.add('active');

                const category = this.dataset.category;
                document.querySelectorAll('.content-card').forEach(card => {
                    card.style.display =
                        category === 'all'
                        || card.dataset.category === category ? 'flex' : 'none';
                });
            });
        });
        // Ouvrir le modal d'abonnement
document.querySelectorAll('.btn-lecture').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault(); // Empêche le comportement précédent
        openSubscriptionModal();
    });
});

function openSubscriptionModal() {
    document.getElementById('subscriptionModal').style.display = 'flex';
}

function closeSubscriptionModal() {
    document.getElementById('subscriptionModal').style.display = 'none';
}

function subscribe() {
    // Ici tu peux rediriger vers ta page paiement/abonnement
    alert("Redirection vers la page d'abonnement...");
    window.location.href = "/abonnement"; // Modifier avec ton URL
}

// Fermer modal si clic en dehors
window.onclick = function(event) {
    const modal = document.getElementById('subscriptionModal');
    if (event.target === modal) {
        closeSubscriptionModal();
    }
};
// Dans un fichier JS ou dans une balise <script>

    </script>
    <!-- Modal Abonnement -->
<div id="subscriptionModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSubscriptionModal()">&times;</span>
        <h2>Accès réservé</h2>
        <p>Veuillez vous connecter ou créer un compte</p>
    <a href="{{ route('front.inscrit') }}">
    <button class="btn btn-outline" >
        Se Connecter
    </button></a>

        <button class="btn btn-outline" onclick="closeSubscriptionModal()">Annuler</button>
    </div>
</div>


</body>
</html>
