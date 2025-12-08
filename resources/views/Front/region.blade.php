@extends('layout1')

@section('css')
<style>
/* Variables de couleurs */
:root {
    --primary-color: #008751;
    --primary-dark: #006b40;
    --primary-light: #e0f2eb;
    --secondary-color: #f8f9fa;
    --text-color: #333;
    --text-light: #666;
    --border-color: #e5e7eb;
    --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Page container */
.regions-page {
    padding: 40px 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.page-header {
    text-align: center;
    margin-bottom: 40px;
    position: relative;
}

.page-header h1 {
    font-size: 2.8rem;
    color: var(--primary-color);
    margin-bottom: 10px;
    font-weight: 700;
    position: relative;
    display: inline-block;
}

.page-header h1::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 4px;
    background: var(--primary-color);
    border-radius: 2px;
}

.page-header .subtitle {
    font-size: 1.2rem;
    color: var(--text-light);
    max-width: 700px;
    margin: 20px auto;
    line-height: 1.6;
}

/* Statistiques */
.stats-section {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 40px;
    box-shadow: var(--shadow);
    border: 2px solid var(--primary-light);
}

.stats-section h2 {
    color: var(--primary-color);
    margin-bottom: 20px;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.stat-card {
    background: var(--primary-light);
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    border-left: 4px solid var(--primary-color);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--primary-color);
    display: block;
    margin-bottom: 8px;
}

.stat-label {
    font-size: 1rem;
    color: var(--text-color);
    font-weight: 500;
}

.stat-note {
    font-size: 0.85rem;
    color: var(--text-light);
    margin-top: 5px;
    font-style: italic;
}

/* Filtres et recherche */
.filter-section {
    background: white;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: var(--shadow);
}

.search-box {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-box input {
    flex: 1;
    padding: 12px 20px;
    border: 2px solid var(--border-color);
    border-radius: 10px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(0, 135, 81, 0.1);
}

.search-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 500;
    transition: background 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-btn:hover {
    background: var(--primary-dark);
}

.filters {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-group label {
    display: block;
    margin-bottom: 8px;
    color: var(--text-color);
    font-weight: 500;
}

.filter-group select {
    width: 100%;
    padding: 10px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 1rem;
    background: white;
}

/* Grid des régions */
.regions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.region-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: all 0.3s ease;
    border: 2px solid transparent;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.region-card:hover {
    transform: translateY(-10px);
    border-color: var(--primary-color);
    box-shadow: 0 10px 30px rgba(0, 135, 81, 0.15);
}

.region-header {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 25px;
    position: relative;
    min-height: 120px;
}

.region-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1.3;
}

.region-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.region-content {
    padding: 25px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.region-info {
    margin-bottom: 20px;
}

.info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border-color);
}

.info-label {
    color: var(--text-light);
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-value {
    color: var(--text-color);
    font-weight: 600;
}

.region-description {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 20px;
    flex-grow: 1;
    font-size: 0.95rem;
}

.read-more {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: color 0.3s;
}

.read-more:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

/* Bouton d'action */
.region-actions {
    margin-top: 20px;
    display: flex;
    gap: 10px;
}

.details-btn {
    flex: 1;
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
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

.pagination li {
    margin: 0;
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
    border: 2px solid var(--border-color);
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

.pagination .disabled span {
    background: #f8f9fa;
    color: #999;
    cursor: not-allowed;
}

/* Carte de localisation (optionnel) */
.map-container {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-top: 40px;
    box-shadow: var(--shadow);
}

.map-container h2 {
    color: var(--primary-color);
    margin-bottom: 20px;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Responsive */
@media (max-width: 768px) {
    .regions-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .search-box {
        flex-direction: column;
    }
    
    .filters {
        flex-direction: column;
    }
    
    .page-header h1 {
        font-size: 2rem;
    }
    
    .region-actions {
        flex-direction: column;
    }
}

/* Animation de chargement */
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

.region-card {
    animation: fadeIn 0.5s ease-out;
}

/* Icônes */
.icon {
    width: 20px;
    height: 20px;
    fill: currentColor;
}

/* Légende */
.legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
    flex-wrap: wrap;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: var(--text-light);
}

.legend-color {
    width: 15px;
    height: 15px;
    border-radius: 3px;
}

/* Message vide */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 15px;
    box-shadow: var(--shadow);
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
    margin: 0 auto 20px;
}
</style>
@endsection

@section('content')
<div class="regions-page">
    <!-- En-tête de la page -->
    <div class="page-header">
        <h1>📌 Régions du Bénin</h1>
        <p class="subtitle">Découvrez les 12 régions administratives du Bénin avec leurs caractéristiques démographiques, géographiques et culturelles.</p>
    </div>

    <!-- Statistiques générales -->
    <div class="stats-section">
        <h2><i class="fas fa-chart-bar"></i> Statistiques Nationales</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <span class="stat-number">{{ $stats['total_regions'] }}</span>
                <span class="stat-label">Régions</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ number_format($stats['total_population'], 0, ',', ' ') }}</span>
                <span class="stat-label">Population totale</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ number_format($stats['total_superficie'], 0, ',', ' ') }} km²</span>
                <span class="stat-label">Superficie totale</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">{{ number_format($stats['population_moyenne'], 0, ',', ' ') }}</span>
                <span class="stat-label">Population moyenne par région</span>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="filter-section">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Rechercher une région par nom, description ou localisation...">
            <button class="search-btn" onclick="searchRegions()">
                <i class="fas fa-search"></i> Rechercher
            </button>
        </div>
        
        <div class="filters">
            <div class="filter-group">
                <label for="sortBy"><i class="fas fa-sort"></i> Trier par</label>
                <select id="sortBy" onchange="sortRegions()">
                    <option value="nom_asc">Nom (A-Z)</option>
                    <option value="nom_desc">Nom (Z-A)</option>
                    <option value="population_desc">Population (décroissant)</option>
                    <option value="population_asc">Population (croissant)</option>
                    <option value="superficie_desc">Superficie (décroissant)</option>
                    <option value="superficie_asc">Superficie (croissant)</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="populationFilter"><i class="fas fa-users"></i> Filtre population</label>
                <select id="populationFilter" onchange="filterByPopulation()">
                    <option value="all">Toutes</option>
                    <option value="small">Moins de 500k habitants</option>
                    <option value="medium">500k - 1M habitants</option>
                    <option value="large">Plus de 1M habitants</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="superficieFilter"><i class="fas fa-mountain"></i> Filtre superficie</label>
                <select id="superficieFilter" onchange="filterBySuperficie()">
                    <option value="all">Toutes</option>
                    <option value="small">Moins de 10k km²</option>
                    <option value="medium">10k - 20k km²</option>
                    <option value="large">Plus de 20k km²</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Légende -->
    <div class="legend">
        <div class="legend-item">
            <div class="legend-color" style="background: #008751;"></div>
            <span>Informations principales</span>
        </div>
        <div class="legend-item">
            <div class="legend-color" style="background: #e0f2eb;"></div>
            <span>Statistiques</span>
        </div>
    </div>

    <!-- Grid des régions -->
    @if($regions->count() > 0)
        <div class="regions-grid">
            @foreach($regions as $region)
                <div class="region-card">
                    <div class="region-header">
                        <h3>{{ $region->nom_region }}</h3>
                        <div class="region-badge">
                            <i class="fas fa-map-marker-alt"></i> Région
                        </div>
                    </div>
                    
                    <div class="region-content">
                        <div class="region-info">
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="fas fa-users"></i> Population
                                </span>
                                <span class="info-value">
                                    {{ number_format($region->population, 0, ',', ' ') }} hab.
                                </span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="fas fa-expand-alt"></i> Superficie
                                </span>
                                <span class="info-value">
                                    {{ number_format($region->superficie, 0, ',', ' ') }} km²
                                </span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="fas fa-map-pin"></i> Localisation
                                </span>
                                <span class="info-value">
                                    {{ $region->localisation }}
                                </span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="fas fa-chart-line"></i> Densité
                                </span>
                                <span class="info-value">
                                    {{ number_format($region->population / $region->superficie, 1) }} hab/km²
                                </span>
                            </div>
                        </div>
                        
                        <div class="region-description">
                            @if(strlen($region->description) > 150)
                                {{ substr($region->description, 0, 150) }}...
                            @else
                                {{ $region->description }}
                            @endif
                        </div>
                        
                        <div class="region-actions">
                            <a href="{{ route('regionshow', $region->id) }}" class="details-btn">
                                <i class="fas fa-info-circle"></i> Voir détails
                            </a>
                            <button class="details-btn" style="background: #6c757d;" onclick="showOnMap('{{ $region->nom_region }}', '{{ $region->localisation }}')">
                                <i class="fas fa-map"></i> Carte
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="pagination-container">
            {{ $regions->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-map-marked-alt"></i>
            <h3>Aucune région trouvée</h3>
            <p>Les régions du Bénin n'ont pas encore été ajoutées à la base de données.</p>
        </div>
    @endif

    <!-- Carte interactive (exemple avec OpenStreetMap) -->
    <div class="map-container">
        <h2><i class="fas fa-map-marked-alt"></i> Carte des Régions</h2>
        <div id="map" style="height: 400px; border-radius: 10px; overflow: hidden;"></div>
        <div style="text-align: center; margin-top: 15px; color: #666; font-size: 0.9rem;">
            <i class="fas fa-info-circle"></i> Cliquez sur "Carte" dans chaque région pour la localiser
        </div>
    </div>
</div>

<!-- JavaScript pour les fonctionnalités -->
<script>
// Données des régions (seraient normalement chargées via AJAX)
const regionsData = @json($regions->items());

// Fonction de recherche
function searchRegions() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.region-card');
    
    cards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const description = card.querySelector('.region-description').textContent.toLowerCase();
        const location = card.querySelector('.info-row:nth-child(3) .info-value').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm) || location.includes(searchTerm)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// Fonction de tri
function sortRegions() {
    const sortBy = document.getElementById('sortBy').value;
    // Implémentez le tri via AJAX ou JavaScript
    console.log('Trier par:', sortBy);
}

// Filtres
function filterByPopulation() {
    const filter = document.getElementById('populationFilter').value;
    // Implémentez le filtrage
    console.log('Filtrer population:', filter);
}

function filterBySuperficie() {
    const filter = document.getElementById('superficieFilter').value;
    // Implémentez le filtrage
    console.log('Filtrer superficie:', filter);
}

// Carte interactive
let map;
function initMap() {
    // Coordonnées centrales du Bénin
    map = L.map('map').setView([9.3077, 2.3158], 7);
    
    // Ajouter la couche OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    // Ajouter des marqueurs pour chaque région
    regionsData.forEach(region => {
        // Ici, vous devriez avoir des coordonnées GPS pour chaque région
        // Pour l'exemple, nous utilisons des coordonnées approximatives
        L.marker(getCoordinatesForRegion(region.localisation))
            .bindPopup(`
                <strong>${region.nom_region}</strong><br>
                Population: ${region.population.toLocaleString()} hab.<br>
                Superficie: ${region.superficie.toLocaleString()} km²
            `)
            .addTo(map);
    });
}

// Fonction utilitaire pour obtenir des coordonnées (à adapter)
function getCoordinatesForRegion(localisation) {
    // Cette fonction devrait retourner [lat, lng] selon la localisation
    // Pour l'exemple, retournons des coordonnées aléatoires dans le Bénin
    const beninBounds = {
        lat: [6.25, 12.25],
        lng: [0.75, 3.85]
    };
    
    return [
        beninBounds.lat[0] + Math.random() * (beninBounds.lat[1] - beninBounds.lat[0]),
        beninBounds.lng[0] + Math.random() * (beninBounds.lng[1] - beninBounds.lng[0])
    ];
}

// Afficher une région sur la carte
function showOnMap(regionName, location) {
    alert(`Afficher ${regionName} sur la carte à ${location}`);
    // Ici, vous pourriez centrer la carte sur cette région
    // et ouvrir son popup
}

// Initialiser la carte quand la page est chargée
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('map')) {
        // Charger Leaflet.js si nécessaire
        if (typeof L === 'undefined') {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css';
            document.head.appendChild(link);
            
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js';
            script.onload = initMap;
            document.head.appendChild(script);
        } else {
            initMap();
        }
    }
    
    // Recherche en temps réel
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                searchRegions();
            }
        });
    }
});
</script>

<!-- Chargement de Leaflet pour la carte -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- FontAwesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection