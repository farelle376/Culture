


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dashboard') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('adminlte/css1/layout1.css') }}" />
     
    <link rel="stylesheet" href="{{ URL::asset('adminlte/css/adminlte.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" id="toggleSidebar">‹</button>
        <div class="logo">
            <div style="width: 40px; height: 40px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary-color); font-weight: bold;">CB</div>
            <div class="logo-text">
                <h1>Culture Bénin</h1>
            </div>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('dashboard') }}" class="active"><i>📊</i> <span class="nav-text">Tableau de Bord</span></a></li>
            <li><a href="{{ route('contenus.index') }}"><i>📝</i> <span class="nav-text">Contenus</span></a></li>
            <li><a href="{{ route('regions.index') }}"><i>🌍</i> <span class="nav-text">Régions</span></a></li>
            <li><a href="{{ route('utilisateurs.index') }}"><i>👥</i> <span class="nav-text">Utilisateurs</span></a></li>
            <li><a href="{{ route('langues.index') }}"><i>📋</i> <span class="nav-text">Langues</span></a></li>
            <li><a href="{{ route('medias.index') }}"><i>⚙️</i> <span class="nav-text">Media</span></a></li>
            <li><a href="{{ route('typeMedias.index') }}"><i>🎬</i> <span class="nav-text">TypeMedia</span></a></li>
            <li><a href="{{ route('typeContenus.index') }}"><i>🗂️</i> <span class="nav-text">TypeContenu</span></a></li>
            <li><a href="{{ route('roles.index') }}"><i>🏷️</i> <span class="nav-text">Role</span></a></li>
            <li><a href="{{ route('commentaires.index') }}"><i>💬</i> <span class="nav-text">Commentaire</span></a></li>
            <li><a href="{{ route('register') }}"><i>➕</i> <span class="nav-text">Créer un utilisateur</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header" style="display:flex; justify-content: space-between; align-items:center; padding:1rem; border-bottom:1px solid #ddd;">
            <div>
                @isset($header)
                    <h1>{{ $header }}</h1>
                @endisset
            </div>

            @auth
            <div class="user-info">
    <div class="user-avatar">
        {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
    </div>

    <div class="user-name" onclick="toggleUserMenu()">
        {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
        <span class="arrow">▾</span>
    </div>

    <!-- MENU DÉROULANT -->
    <div id="userMenu" class="user-menu">
        <a href="{{ route('profil.show') }}">Voir mon profil</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </div>
</div>
            @endauth
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Welcome Banner -->
             @yield('title')
           

            <!-- Quick Actions -->
            @yield('content')
        </div>
    </div>

    <script>
        // Ici tu peux garder tous tes scripts existants pour graphiques et sidebar
    </script>
</body>
</html>




 <!-- MODAL LECTURE CONTENU -->
    <div id="contenuModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <span class="close" onclick="closeContenuModal()">&times;</span>
            <h2 id="modalTitre"></h2>
            <div id="modalMedia" style="margin: 15px 0;"></div>
            <p><strong>Région :</strong> <span id="modalRegion"></span></p>
            <p><strong>Langue :</strong> <span id="modalLangue"></span></p>
            <p id="modalDescription" style="margin-top:15px;"></p>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLoginModal()">&times;</span>
            <h2>Connexion</h2>

            <form id="loginForm">
                <label>Email</label>
                <input type="email" required>

                <label>Mot de passe</label>
                <input type="password" required>

                <button class="btn btn-primary" style="width:100%">Se connecter</button>
            </form>

            <p style="margin-top:20px">Pas encore de compte ?
                <a href="#" onclick="closeLoginModal(); openRegisterModal()">Créer un compte</a>
            </p>
        </div>
    </div>

    <!-- Register Modal -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeRegisterModal()">&times;</span>
            <h2>Créer un compte</h2>

            <form method="POST" action="{{ route('utilisateurs.store') }}">
                @csrf
                <div style="display:flex; gap:20px;">
                    <input type="text" name="nom" placeholder="Nom" required>
                    <input type="text" name="prenom" placeholder="Prénom" required>
                </div>

                <input type="email" name="email" placeholder="Email" required>

                <div style="display:flex; gap:20px;">
                    <input type="date" name="date_naissance" required>
                    <select name="sexe">
                        <option value="">Sexe</option>
                        <option value="feminin">Féminin</option>
                        <option value="masculin">Masculin</option>
                    </select>
                </div>

                <div style="display:flex; gap:20px;">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <select name="nom_langue">
                        <option value="">Langue</option>
                        <option>Goun</option>
                        <option>Fon</option>
                        <option>Bariba</option>
                        <option>Dendi</option>
                        <option>Yoruba</option>
                    </select>
                </div>

                <button class="btn btn-primary" style="width:100%">S'inscrire</button>
            </form>
        </div>
