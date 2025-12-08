@extends('layout1')

@section('css')
<style>
    :root {
        --primary-color: #008751;
        --secondary-color: #fcd116;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --gray-color: #6b7280;
        --light-gray: #f3f4f6;
    }
    
    .user-contenus-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }
    
    /* Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-color));
        color: white;
        padding: 25px 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
    }
    
    .page-header h1 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 600;
    }
    
    .page-header p {
        opacity: 0.9;
        margin-top: 5px;
        margin-bottom: 0;
    }
    
    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-left: 4px solid var(--primary-color);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-card .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }
    
    .stat-card .stat-label {
        color: var(--gray-color);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    /* Filtres */
    .filters-section {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        padding: 8px 20px;
        border-radius: 25px;
        border: 2px solid #e5e7eb;
        background: white;
        color: var(--gray-color);
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .filter-btn:hover, .filter-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }
    
    /* Grid des contenus */
    .contenus-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }
    
    /* Carte de contenu (votre design) */
    .content-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .content-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    
    .content-img {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .content-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        backdrop-filter: blur(10px);
    }
    
    .content-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .content-body h3 {
        margin: 0 0 15px 0;
        color: #1f2937;
        font-size: 1.2rem;
        font-weight: 600;
        line-height: 1.4;
    }
    
    .content-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .content-meta span {
        background: var(--light-gray);
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 0.8rem;
        color: var(--gray-color);
    }
    
    .content-language {
        background: var(--primary-color) !important;
        color: white !important;
        font-weight: 500;
    }
    
    .my-content-badge {
        background: var(--secondary-color) !important;
        color: white !important;
        font-weight: 500;
    }
    
    .rating {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .stars {
        display: flex;
        gap: 2px;
    }
    
    .star {
        color: #d1d5db;
        font-size: 1.1rem;
    }
    
    .star.active {
        color: #f59e0b;
    }
    
    .rating-value {
        font-weight: 600;
        color: var(--gray-color);
        font-size: 0.9rem;
    }
    
    .content-description {
        color: var(--gray-color);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 20px;
        flex: 1;
    }
    
    .content-actions {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }
    
    .btn {
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        text-decoration: none;
    }
    
    .btn-primary {
        background: var(--primary-color);
        color: white;
    }
    
    .btn-primary:hover {
        background: #008751;
    }
    
    .btn-outline {
        background: transparent;
        border: 1px solid #d1d5db;
        color: var(--gray-color);
    }
    
    .btn-outline:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 0.85rem;
    }
    
    /* Statut badges */
    .status-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        backdrop-filter: blur(10px);
    }
    
    .status-approved {
        background: rgba(16, 185, 129, 0.9);
    }
    
    .status-pending {
        background: rgba(245, 158, 11, 0.9);
    }
    
    .status-rejected {
        background: rgba(239, 68, 68, 0.9);
    }
    
    .status-draft {
        background: rgba(107, 114, 128, 0.9);
    }
    
    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }
    
    .pagination {
        display: flex;
        gap: 5px;
    }
    
    .page-link {
        padding: 8px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        color: var(--primary-color);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .page-link:hover, .page-item.active .page-link {
        background: var(--primary-color);
        color: white;
        border-color: var(--primary-color);
    }
    
    /* État vide */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        grid-column: 1 / -1;
    }
    
    .empty-icon {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        color: #1f2937;
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: var(--gray-color);
        margin-bottom: 30px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .user-contenus-container {
            padding: 15px;
        }
        
        .contenus-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .stats-container {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .filter-buttons {
            justify-content: center;
        }
        
        .page-header {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="user-contenus-container">
    <!-- Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1><i class="fas fa-file-alt me-2"></i>Mes Contenus</h1>
                <p>Gérez et consultez tous vos contenus publiés</p>
            </div>
            <a href="{{ route('ajouter-contenu') }}" class="btn btn-light">
                <i class="fas fa-plus me-2"></i>Nouveau contenu
            </a>
        </div>
    </div>
    
    <!-- Statistiques -->
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div class="stat-label">Total des contenus</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['approved'] }}</div>
            <div class="stat-label">Contenus publiés</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['pending'] }}</div>
            <div class="stat-label">En attente</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['rejected'] }}</div>
            <div class="stat-label">Rejetés</div>
        </div>
    </div>
    
    <!-- Filtres -->
    <div class="filters-section">
        <h4 class="mb-3">Filtrer par statut :</h4>
        <div class="filter-buttons">
            <a href="{{ route('mes-contenus', ['filtre' => 'all']) }}" 
               class="filter-btn {{ $filtreActif == 'all' ? 'active' : '' }}">
                <i class="fas fa-layer-group me-2"></i>Tous
            </a>
            <a href="{{ route('mes-contenus', ['filtre' => 'approved']) }}" 
               class="filter-btn {{ $filtreActif == 'approved' ? 'active' : '' }}">
                <i class="fas fa-check-circle me-2"></i>Publiés
            </a>
            <a href="{{ route('mes-contenus', ['filtre' => 'pending']) }}" 
               class="filter-btn {{ $filtreActif == 'pending' ? 'active' : '' }}">
                <i class="fas fa-clock me-2"></i>En attente
            </a>
            <a href="{{ route('mes-contenus', ['filtre' => 'rejected']) }}" 
               class="filter-btn {{ $filtreActif == 'rejected' ? 'active' : '' }}">
                <i class="fas fa-times-circle me-2"></i>Rejetés
            </a>
        </div>
    </div>
    
    <!-- Grid des contenus -->
    <div class="contenus-grid">
        @if($contenus->count() > 0)
            @foreach($contenus as $contenu)
                <div class="content-card" data-category="mes-contenus">
                    <!-- Image avec badge de statut -->
                    <div class="content-img" 
                         style="background-image: url('{{ $contenu->image_url ?: URL::asset('adminlte/img/img22.jpeg') }}');">
                        
                        <!-- Badge de statut -->
                        <div class="status-badge 
                            @if($contenu->status == 'approved') status-approved
                            @elseif($contenu->status == 'pending') status-pending
                            @elseif($contenu->status == 'rejected') status-rejected
                            @else status-draft @endif">
                            @if($contenu->status == 'approved')
                                <i class="fas fa-check me-1"></i> Publié
                            @elseif($contenu->status == 'pending')
                                <i class="fas fa-clock me-1"></i> En attente
                            @elseif($contenu->status == 'rejected')
                                <i class="fas fa-times me-1"></i> Rejeté
                            @else
                                <i class="fas fa-save me-1"></i> Brouillon
                            @endif
                        </div>
                        
                        <!-- Type de contenu -->
                        <div class="content-badge">
                            {{ $contenu->typeContenu->nom ?? 'Non spécifié' }}
                        </div>
                    </div>
                    
                    <div class="content-body">
                        <h3>{{ $contenu->titre ?? 'Sans titre' }}</h3>
                        
                        <div class="content-meta">
                            @if($contenu->region)
                                <span>Région: {{ $contenu->region->nom ?? 'Non spécifié' }}</span>
                            @endif
                            
                            @if($contenu->langue)
                                <div class="content-language">
                                    {{ $contenu->langue->nom ?? 'Non spécifié' }}
                                </div>
                            @endif
                            
                            <span class="my-content-badge">Mon contenu</span>
                        </div>
                        
                        <!-- Rating -->
                        <div class="rating">
                            <div class="stars">
                                @php
                                    $rating = $contenu->rating ?? 0;
                                    $fullStars = floor($rating);
                                    $hasHalfStar = $rating - $fullStars >= 0.5;
                                @endphp
                                
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $fullStars ? 'active' : ($hasHalfStar && $i == $fullStars + 1 ? 'half' : '') }}">
                                        ★
                                    </span>
                                @endfor
                            </div>
                            <span class="rating-value">{{ number_format($rating, 1) }}</span>
                        </div>
                        
                        <p class="content-description">
                            {{ Str::limit(strip_tags($contenu->texte), 120) }}
                        </p>
                        
                        <div class="content-actions">
                            <a href="{{ route('voir-contenu', $contenu->id) }}" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>
                                <span>Voir détails</span>
                            </a>
                            
                            @if($contenu->status == 'pending' || $contenu->status == 'rejected' || $contenu->status == 'draft')
                                <a href="{{ route('editer-contenu', $contenu->id) }}" 
                                   class="btn btn-outline btn-sm">
                                    <i class="fas fa-edit me-1"></i>
                                    <span>Modifier</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>Aucun contenu trouvé</h3>
                <p>
                    @if($filtreActif == 'all')
                        Vous n'avez pas encore créé de contenu. Commencez par en créer un !
                    @elseif($filtreActif == 'approved')
                        Vous n'avez aucun contenu publié.
                    @elseif($filtreActif == 'pending')
                        Vous n'avez aucun contenu en attente de validation.
                    @elseif($filtreActif == 'rejected')
                        Vous n'avez aucun contenu rejeté.
                    @endif
                </p>
                <a href="{{ route('ajouter-contenu') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Créer un contenu
                </a>
            </div>
        @endif
    </div>
    
    <!-- Pagination -->
    @if($contenus->hasPages())
        <div class="pagination-container">
            <nav>
                <ul class="pagination">
                    @if($contenus->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $contenus->previousPageUrl() }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    @for($i = 1; $i <= $contenus->lastPage(); $i++)
                        <li class="page-item {{ $i == $contenus->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $contenus->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if($contenus->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $contenus->nextPageUrl() }}">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des filtres
        const filterBtns = document.querySelectorAll('.filter-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (this.classList.contains('active')) {
                    e.preventDefault();
                }
            });
        });
        
        // Animation des cartes
        const contentCards = document.querySelectorAll('.content-card');
        contentCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Auto-refresh pour les contenus en attente
        @if($filtreActif == 'pending')
            setTimeout(function() {
                location.reload();
            }, 30000); // Toutes les 30 secondes
        @endif
    });
</script>
@endsection