<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeninCulture - Tableau de Bord</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('css')
   <link rel="stylesheet" href="{{ URL::asset('adminlte/css1/layout.css') }}" />
   <link rel="stylesheet" href="{{ URL::asset('adminlte/css/adminlte.css') }}" />
   <link rel="stylesheet" href="http://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
   <script src="http://code.jquery.com/query-3.7.0.js"></script>
   <script src="http://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-mask"></i>
                <span class="logo-text">BeninCulture</span>
            </div>
            <button class="toggle-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
        </div>
        <ul class="nav-links">
            <li><a href="#" class="active"><i class="fas fa-home"></i> <span class="nav-text">Tableau de Bord</span></a></li>
            <li><a href="{{route('langues.index') }}"><i class="fas fa-users"></i> <span class="nav-text">Utilisateurs</span></a></li>
            <li><a href="{{route('langues.index') }}"><i class="fas fa-language"></i> <span class="nav-text">Langue</span></a></li>
            <li><a href="{{route('contenus.index') }}"><i class="fas fa-file-alt"></i> <span class="nav-text">Contenu</span></a></li>
            <li><a href="{{route('regions.index') }}"><i class="fas fa-map-marker-alt"></i> <span class="nav-text">Région</span></a></li>
            <li><a href="{{route('medias.index') }}"><i class="fas fa-photo-video"></i> <span class="nav-text">Média</span></a></li>
            <li><a href="{{route('typeMedias.index') }}"><i class="fas fa-film"></i> <span class="nav-text">TypeMedia</span></a></li>
            <li><a href="{{route('typeContenus.index') }}"><i class="fas fa-tags"></i> <span class="nav-text">TypeContenu</span></a></li>
            <li><a href="{{route('roles.index') }}"><i class="fas fa-user-shield"></i> <span class="nav-text">Role</span></a></li>
            <li><a href="{{route('commentaires.index') }}"><i class="fas fa-comments"></i> <span class="nav-text">Commentaire</span></a></li>
           
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Tableau de Bord BeninCulture</h1>
            <div class="user-info">
                <div class="user-avatar">AC</div>
                <div>
                    <p>Admin C</p>
                </div>
            </div>
        </div>
        
        <!-- Stats Cards -->
         @yield('title')
        @yield('content')
        
        <!-- Footer -->
         <br><br><br><br><br><br>
        <footer>
           
            <div class="copyright">
                <p>&copy; 2023 BeninCulture - Tous droits réservés</p>
            </div>
        </footer>
    </div>

    <script>
        // Gestion du menu escamotable
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.querySelector('.toggle-btn');
            const sidebar = document.querySelector('.sidebar');
            
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
            
            // Simulation de données en temps réel
            function updateStats() {
                const userCount = document.querySelector('.stat-card:nth-child(1) h3');
                const contentCount = document.querySelector('.stat-card:nth-child(2) h3');
                
                // Simulation d'augmentation des statistiques
                const currentUsers = parseInt(userCount.textContent);
                const currentContents = parseInt(contentCount.textContent);
                
                userCount.textContent = currentUsers + Math.floor(Math.random() * 3);
                contentCount.textContent = currentContents + Math.floor(Math.random() * 2);
            }
            
            // Mettre à jour les stats toutes les 30 secondes (simulation)
            setInterval(updateStats, 30000);
            
            // Gestion des clics sur les liens du menu
            
        });
    </script>
    @yield('script')
</body>
</html>