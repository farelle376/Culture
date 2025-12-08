


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
<style>
    .user-menu {
    position: absolute;
    top: 60px;
    right: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 10px;
    display: none;
    z-index: 1000;
}

.user-menu.open {
    display: block;
}

.user-menu a,
.user-menu button {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #333;
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    cursor: pointer;
}

.user-menu a:hover,
.user-menu button:hover {
    background: #f1f1f1;
}

</style>
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
        <a href="{{ route('profils.show', Auth::user()->id) }}">Voir mon profil</a>

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
        // Sélecteurs
const userAvatar = document.querySelector('.user-avatar'); 
const userMenu = document.getElementById('userMenu');

// Toggle menu au clic sur l'avatar
userAvatar.addEventListener('click', (e) => {
    e.stopPropagation(); // Empêche le clic de fermer immédiatement
    userMenu.classList.toggle('open');
});

// Fermer le menu si on clique ailleurs
document.addEventListener('click', () => {
    if (userMenu.classList.contains('open')) {
        userMenu.classList.remove('open');
    }
});

        // Ici tu peux garder tous tes scripts existants pour graphiques et sidebar
    </script>
</body>
</html>
