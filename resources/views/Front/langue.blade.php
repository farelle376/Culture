@extends('layout1')

@section('title', 'Langues du Bénin')

@section('css')
<style>
/* Variables de couleurs */
:root {
    --primary-color: #008751;
    --primary-dark: #006b40;
    --primary-light: #e0f2eb;
    --text-color: #333;
    --text-light: #666;
    --border-color: #e5e7eb;
    --shadow: 0 4px 15px rgba(0,0,0,0.1);
}

/* Page container */
.langues-page {
    padding: 40px 20px;
    background: #f8f9fa;
    min-height: 100vh;
}

/* En-tête */
.page-header {
    text-align: center;
    margin-bottom: 40px;
}

.page-header h1 {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 15px;
    font-weight: 700;
}

.page-header .subtitle {
    font-size: 1.2rem;
    color: var(--text-light);
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Statistiques */
.stats-section {
    background: white;
    border-radius: 12px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: var(--shadow);
    text-align: center;
    border: 2px solid var(--primary-light);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    color: var(--primary-color);
    display: block;
    margin-bottom: 10px;
}

.stat-label {
    font-size: 1.2rem;
    color: var(--text-color);
    font-weight: 600;
}

/* Recherche */
.search-section {
    background: white;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: var(--shadow);
}

.search-container {
    position: relative;
    max-width: 600px;
    margin: 0 auto;
}

.search-icon {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
}

.search-box {
    width: 100%;
    padding: 15px 20px 15px 50px;
    border: 2px solid var(--border-color);
    border-radius: 50px;
    font-size: 1rem;
    transition: all 0.3s;
}

.search-box:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--primary-light);
}

/* Grid des langues */
.langues-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.langue-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.langue-card:hover {
    transform: translateY(-5px);
    border-color: var(--primary-color);
    box-shadow: 0 10px 25px rgba(0, 135, 81, 0.15);
}

.langue-header {
    background: var(--primary-color);
    color: white;
    padding: 20px;
}

.langue-header h3 {
    margin: 0 0 5px 0;
    font-size: 1.4rem;
    font-weight: 600;
}

.langue-code {
    font-size: 0.9rem;
    opacity: 0.9;
    font-family: monospace;
}

.langue-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.langue-description {
    color: var(--text-color);
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
    font-size: 0.95rem;
}

.langue-actions {
    margin-top: 15px;
}

.details-btn {
    width: 100%;
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.3s;
    text-decoration: none;
    text-align: center;
}

.details-btn:hover {
    background: var(--primary-dark);
    color: white;
    text-decoration: none;
}

/* Pagination */
.pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
}

.pagination a, .pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
    padding: 0 15px;
    border-radius: 8px;
    background: white;
    color: var(--text-color);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
    border: 1px solid var(--border-color);
}

.pagination a:hover {
    background: var(--primary-light);
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.pagination .active span {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* Message vide */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: var(--shadow);
    margin: 40px 0;
}

.empty-state i {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-state h3 {
    color: var(--text-color);
    margin-bottom: 10px;
}

.empty-state p {
    color: var(--text-light);
    max-width: 500px;
    margin: 0 auto;
}

/* Responsive */
@media (max-width: 768px) {
    .langues-grid {
        grid-template-columns: 1fr;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .langues-page {
        padding: 20px 15px;
    }
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.langue-card {
    animation: fadeIn 0.5s ease-out;
}
</style>
@endsection

@section('content')
<div class="langues-page">
    <!-- En-tête de la page -->
    <div class="page-header">
        <h1>🌍 Langues du Bénin</h1>
        <p class="subtitle">
            Découvrez la diversité linguistique du Bénin. Le pays compte de nombreuses langues 
            qui reflètent sa richesse culturelle et son histoire.
        </p>
    </div>

    <!-- Statistiques -->
    <div class="stats-section">
        <span class="stat-number">{{ $stats['total_langues'] }}</span>
        <span class="stat-label">Langues recensées</span>
    </div>

    <!-- Recherche -->
    <div class="search-section">
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" 
                   id="searchInput" 
                   class="search-box" 
                   placeholder="Rechercher une langue..."
                   onkeyup="searchLangues()">
        </div>
    </div>

    <!-- Grid des langues -->
    @if($langues->count() > 0)
        <div class="langues-grid" id="languesGrid">
            @foreach($langues as $langue)
                <div class="langue-card">
                    <div class="langue-header">
                        <h3>{{ $langue->nom_langue }}</h3>
                        <div class="langue-code">{{ $langue->code_langue }}</div>
                    </div>
                    
                    <div class="langue-content">
                        <div class="langue-description">
                            @if(strlen($langue->description) > 200)
                                {{ substr($langue->description, 0, 200) }}...
                            @else
                                {{ $langue->description }}
                            @endif
                        </div>
                        
                        <div class="langue-actions">
                            <a href="{{ route('langueshow', $langue->id) }}" class="details-btn">
                                <i class="fas fa-info-circle"></i> Voir les détails
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="pagination-container">
            {{ $langues->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-language"></i>
            <h3>Aucune langue trouvée</h3>
            <p>Les langues n'ont pas encore été ajoutées à la base de données.</p>
        </div>
    @endif
</div>

<!-- JavaScript pour la recherche -->
<script>
function searchLangues() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.langue-card');
    
    cards.forEach(card => {
        const nom = card.querySelector('h3').textContent.toLowerCase();
        const code = card.querySelector('.langue-code').textContent.toLowerCase();
        const description = card.querySelector('.langue-description').textContent.toLowerCase();
        
        if (nom.includes(searchTerm) || code.includes(searchTerm) || description.includes(searchTerm)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Réinitialiser la recherche
document.getElementById('searchInput').addEventListener('search', function() {
    const cards = document.querySelectorAll('.langue-card');
    cards.forEach(card => {
        card.style.display = 'flex';
    });
});
</script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection