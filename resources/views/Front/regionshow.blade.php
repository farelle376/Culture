@extends('layout1')

@section('css')
<style>
/* Styles similaires à la page index */
.region-detail-page {
    padding: 40px 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: white;
    color: #008751;
    border: 2px solid #008751;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 30px;
    transition: all 0.3s;
}

.back-button:hover {
    background: #008751;
    color: white;
}

.region-detail-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    margin-bottom: 40px;
}

.region-detail-header {
    background: linear-gradient(135deg, #008751, #00a86b);
    color: white;
    padding: 40px;
    text-align: center;
}

.region-detail-header h1 {
    font-size: 2.5rem;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.region-detail-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 20px;
}

.region-stats {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.stat-item {
    text-align: center;
    background: rgba(255, 255, 255, 0.1);
    padding: 15px 25px;
    border-radius: 10px;
    backdrop-filter: blur(10px);
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 700;
    display: block;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.region-detail-content {
    padding: 40px;
}

.content-section {
    margin-bottom: 40px;
}

.content-section h2 {
    color: #008751;
    margin-bottom: 20px;
    font-size: 1.8rem;
    display: flex;
    align-items: center;
    gap: 10px;
    border-bottom: 2px solid #e0f2eb;
    padding-bottom: 10px;
}

.description-text {
    line-height: 1.8;
    font-size: 1.1rem;
    color: #333;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-item {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #008751;
}

.detail-item h3 {
    color: #008751;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

.map-container {
    height: 400px;
    border-radius: 15px;
    overflow: hidden;
    margin-top: 20px;
}

.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    flex-wrap: wrap;
}

.action-btn {
    flex: 1;
    min-width: 200px;
    padding: 15px;
    border-radius: 10px;
    border: none;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s;
    text-decoration: none;
}

.action-btn.primary {
    background: #008751;
    color: white;
}

.action-btn.secondary {
    background: white;
    color: #008751;
    border: 2px solid #008751;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}
</style>
@endsection

@section('content')
<div class="region-detail-page">
    <!-- Bouton retour -->
    <a href="{{ route('regions.index') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Retour aux régions
    </a>

    <!-- Carte détaillée de la région -->
    <div class="region-detail-card">
        <div class="region-detail-header">
            <h1>{{ $region->nom_region }}</h1>
            <div class="region-detail-subtitle">
                <i class="fas fa-map-marker-alt"></i> {{ $region->localisation }}
            </div>
            
            <div class="region-stats">
                <div class="stat-item">
                    <span class="stat-value">{{ number_format($region->population, 0, ',', ' ') }}</span>
                    <span class="stat-label">Habitants</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ number_format($region->superficie, 0, ',', ' ') }} km²</span>
                    <span class="stat-label">Superficie</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">{{ number_format($region->population / $region->superficie, 1) }}</span>
                    <span class="stat-label">Densité (hab/km²)</span>
                </div>
            </div>
        </div>
        
        <div class="region-detail-content">
            <!-- Description -->
            <div class="content-section">
                <h2><i class="fas fa-book-open"></i> Description</h2>
                <div class="description-text">
                    {!! nl2br(e($region->description)) !!}
                </div>
            </div>
            
            <!-- Informations détaillées -->
            <div class="content-section">
                <h2><i class="fas fa-info-circle"></i> Informations détaillées</h2>
                <div class="detail-grid">
                    <div class="detail-item">
                        <h3><i class="fas fa-users"></i> Démographie</h3>
                        <p><strong>Population:</strong> {{ number_format($region->population, 0, ',', ' ') }} habitants</p>
                        <p><strong>Croissance:</strong> Données à ajouter</p>
                        <p><strong>Densité:</strong> {{ number_format($region->population / $region->superficie, 1) }} hab/km²</p>
                    </div>
                    
                    <div class="detail-item">
                        <h3><i class="fas fa-mountain"></i> Géographie</h3>
                        <p><strong>Superficie:</strong> {{ number_format($region->superficie, 0, ',', ' ') }} km²</p>
                        <p><strong>Localisation:</strong> {{ $region->localisation }}</p>
                        <p><strong>Climat:</strong> Données à ajouter</p>
                    </div>
                    
                    <div class="detail-item">
                        <h3><i class="fas fa-city"></i> Administration</h3>
                        <p><strong>Chef-lieu:</strong> Données à ajouter</p>
                        <p><strong>Départements:</strong> Données à ajouter</p>
                        <p><strong>Communes:</strong> Données à ajouter</p>
                    </div>
                    
                    <div class="detail-item">
                        <h3><i class="fas fa-chart-line"></i> Économie</h3>
                        <p><strong>Activités principales:</strong> Données à ajouter</p>
                        <p><strong>PIB:</strong> Données à ajouter</p>
                        <p><strong>Ressources:</strong> Données à ajouter</p>
                    </div>
                </div>
            </div>
            
            <!-- Carte -->
            <div class="content-section">
                <h2><i class="fas fa-map-marked-alt"></i> Localisation</h2>
                <div id="regionMap" class="map-container"></div>
            </div>
            
            <!-- Boutons d'action -->
            <div class="action-buttons">
                <a href="{{ route('regions.index') }}" class="action-btn secondary">
                    <i class="fas fa-list"></i> Voir toutes les régions
                </a>
                <button class="action-btn primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Imprimer cette fiche
                </button>
                <button class="action-btn secondary" onclick="shareRegion()">
                    <i class="fas fa-share-alt"></i> Partager
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Initialiser la carte pour cette région
function initRegionMap() {
    // Utiliser Leaflet pour afficher la région
    const map = L.map('regionMap').setView([9.3077, 2.3158], 8);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    // Ajouter un marqueur pour cette région
    L.marker([9.3077, 2.3158])
        .addTo(map)
        .bindPopup(`
            <strong>{{ $region->nom_region }}</strong><br>
            {{ $region->localisation }}
        `)
        .openPopup();
}

// Partager la région
function shareRegion() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $region->nom_region }} - Région du Bénin',
            text: 'Découvrez la région {{ $region->nom_region }} au Bénin',
            url: window.location.href,
        });
    } else {
        // Fallback pour les navigateurs qui ne supportent pas l'API Share
        navigator.clipboard.writeText(window.location.href);
        alert('Lien copié dans le presse-papier !');
    }
}

// Initialiser la carte quand la page est chargée
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('regionMap')) {
        // Vérifier si Leaflet est chargé
        if (typeof L !== 'undefined') {
            initRegionMap();
        }
    }
});
</script>

<!-- Chargement de Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection