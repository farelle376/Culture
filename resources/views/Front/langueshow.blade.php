@extends('layout1')

@section('title', $langue->nom_langue)

@section('css')
<style>
:root {
    --primary-color: #008751;
    --primary-dark: #006b40;
    --primary-light: #e0f2eb;
    --text-color: #333;
    --text-light: #666;
}

.langue-detail-page {
    padding: 40px 20px;
    background: #f8f9fa;
    min-height: 100vh;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: white;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 30px;
    transition: all 0.3s;
}

.back-button:hover {
    background: var(--primary-color);
    color: white;
}

.langue-detail-container {
    max-width: 800px;
    margin: 0 auto;
}

.langue-detail-header {
    background: var(--primary-color);
    color: white;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    margin-bottom: 30px;
}

.langue-detail-header h1 {
    font-size: 2.2rem;
    margin: 0 0 10px 0;
    font-weight: 700;
}

.langue-code-large {
    font-size: 1.2rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 8px 20px;
    border-radius: 50px;
    display: inline-block;
    font-family: monospace;
}

.langue-detail-content {
    background: white;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.content-section {
    margin-bottom: 30px;
}

.content-section h2 {
    color: var(--primary-color);
    margin-bottom: 15px;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--primary-light);
}

.description-text {
    font-size: 1.1rem;
    line-height: 1.7;
    color: var(--text-color);
    white-space: pre-line;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.info-item {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    border-left: 4px solid var(--primary-color);
}

.info-item h3 {
    color: var(--primary-color);
    margin-bottom: 10px;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-item p {
    color: var(--text-color);
    margin: 5px 0;
    font-size: 1rem;
}

.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    flex-wrap: wrap;
}

.action-btn {
    flex: 1;
    min-width: 180px;
    padding: 15px 25px;
    border-radius: 8px;
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
    text-align: center;
}

.action-btn.primary {
    background: var(--primary-color);
    color: white;
}

.action-btn.secondary {
    background: white;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.action-btn.primary:hover {
    background: var(--primary-dark);
}

.action-btn.secondary:hover {
    background: var(--primary-light);
}

/* Responsive */
@media (max-width: 768px) {
    .langue-detail-header h1 {
        font-size: 1.8rem;
    }
    
    .langue-detail-content {
        padding: 20px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .action-btn {
        width: 100%;
    }
}
</style>
@endsection

@section('content')
<div class="langue-detail-page">
    <div class="langue-detail-container">
        <!-- Bouton retour -->
        <a href="{{ route('langues.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Retour aux langues
        </a>

        <!-- En-tête détaillé -->
        <div class="langue-detail-header">
            <h1>{{ $langue->nom_langue }}</h1>
            <div class="langue-code-large">{{ $langue->code_langue }}</div>
        </div>

        <!-- Contenu détaillé -->
        <div class="langue-detail-content">
            <!-- Description -->
            <div class="content-section">
                <h2><i class="fas fa-book-open"></i> Description</h2>
                <div class="description-text">
                    {!! nl2br(e($langue->description)) !!}
                </div>
            </div>

            <!-- Informations -->
            <div class="content-section">
                <h2><i class="fas fa-info-circle"></i> Informations</h2>
                <div class="info-grid">
                    <div class="info-item">
                        <h3><i class="fas fa-code"></i> Code Langue</h3>
                        <p><strong>Code:</strong> {{ $langue->code_langue }}</p>
                    </div>
                    
                    <div class="info-item">
                        <h3><i class="fas fa-users"></i> Utilisateurs</h3>
                        <p><strong>Nombre d'utilisateurs:</strong> {{ $nombre_utilisateurs }}</p>
                    </div>
                    
                    <div class="info-item">
                        <h3><i class="fas fa-database"></i> Enregistrement</h3>
                        <p><strong>Ajouté le:</strong> {{ $langue->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="action-buttons">
                <a href="{{ route('langues.index') }}" class="action-btn secondary">
                    <i class="fas fa-list"></i> Voir toutes les langues
                </a>
                <button class="action-btn primary" onclick="window.print()">
                    <i class="fas fa-print"></i> Imprimer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Animation d'entrée
document.addEventListener('DOMContentLoaded', function() {
    const elements = document.querySelectorAll('.content-section');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, 100 * index);
    });
});
</script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection