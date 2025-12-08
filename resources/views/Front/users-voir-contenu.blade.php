@extends('layout1')

@section('css')
<style>
    .contenu-detail-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .contenu-header {
        background: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .contenu-title {
        color: #2c3e50;
        margin-bottom: 15px;
        border-bottom: 2px solid #f8f9fa;
        padding-bottom: 15px;
    }
    
    .contenu-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .meta-card {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }
    
    .meta-label {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 5px;
    }
    
    .meta-value {
        font-weight: 500;
        color: #2c3e50;
    }
    
    .contenu-body {
        background: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        line-height: 1.8;
        color: #495057;
    }
    
    .contenu-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }
    
    .contenu-actions {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e9ecef;
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin: 30px 0;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    
    .stat-icon {
        font-size: 1.5rem;
        color: #667eea;
        margin-bottom: 10px;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>
@endsection

@section('content')
<div class="contenu-detail-container">
    <!-- En-tête avec métadonnées -->
    <div class="contenu-header">
        <h1 class="contenu-title">{{ $contenu->titre }}</h1>
        
        <!-- Badge de statut -->
        <div class="mb-4">
            @if($contenu->status == 'approved')
                <span class="badge bg-success">
                    <i class="fas fa-check-circle me-2"></i> Publié
                </span>
            @elseif($contenu->status == 'pending')
                <span class="badge bg-warning">
                    <i class="fas fa-clock me-2"></i> En attente de validation
                </span>
            @elseif($contenu->status == 'rejected')
                <span class="badge bg-danger">
                    <i class="fas fa-times-circle me-2"></i> Rejeté
                </span>
            @else
                <span class="badge bg-secondary">
                    <i class="fas fa-save me-2"></i> Brouillon
                </span>
            @endif
        </div>
        
        <!-- Métadonnées -->
        <div class="contenu-meta-grid">
            <div class="meta-card">
                <div class="meta-label">Type</div>
                <div class="meta-value">{{ $contenu->type }}</div>
            </div>
            <div class="meta-card">
                <div class="meta-label">Région</div>
                <div class="meta-value">{{ $contenu->region }}</div>
            </div>
            <div class="meta-card">
                <div class="meta-label">Langue</div>
                <div class="meta-value">{{ $contenu->langue }}</div>
            </div>
            <div class="meta-card">
                <div class="meta-label">Date de création</div>
                <div class="meta-value">{{ $contenu->created_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>
    </div>
    
    <!-- Statistiques -->
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-eye"></i>
            </div>
            <div class="stat-number">{{ $statistiquesContenu['vues'] ?? 0 }}</div>
            <div class="stat-label">Vues</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div class="stat-number">{{ $statistiquesContenu['likes'] ?? 0 }}</div>
            <div class="stat-label">J'aime</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-comment"></i>
            </div>
            <div class="stat-number">{{ $statistiquesContenu['commentaires'] ?? 0 }}</div>
            <div class="stat-label">Commentaires</div>
        </div>
        <div class="stat-item">
            <div class="stat-icon">
                <i class="fas fa-share-alt"></i>
            </div>
            <div class="stat-number">{{ $statistiquesContenu['partages'] ?? 0 }}</div>
            <div class="stat-label">Partages</div>
        </div>
    </div>
    
    <!-- Contenu -->
    <div class="contenu-body">
        {!! nl2br(e($contenu->texte)) !!}
    </div>
    
    <!-- Actions -->
    <div class="contenu-actions">
        <a href="{{ route('users.mes-contenus') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Retour à mes contenus
        </a>
        
        @if($contenu->status == 'pending' || $contenu->status == 'rejected')
            <a href="{{ route('users.editer-contenu', $contenu->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i> Éditer
            </a>
        @endif
        
        @if($contenu->status != 'approved')
            <form action="{{ route('users.supprimer-contenu', $contenu->id) }}" 
                  method="POST" 
                  class="d-inline"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i> Supprimer
                </button>
            </form>
        @endif
    </div>
    
    <!-- Commentaires -->
    @if($contenu->commentaires_count > 0)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-comments me-2"></i>
                    Commentaires ({{ $contenu->commentaires_count }})
                </h5>
            </div>
            <div class="card-body">
                @foreach($commentaires as $commentaire)
                    <div class="comment mb-3 p-3 border rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <strong>{{ $commentaire->user->name ?? 'Utilisateur' }}</strong>
                            <small class="text-muted">{{ $commentaire->created_at->format('d/m/Y H:i') }}</small>
                        </div>
                        <p class="mb-0">{{ $commentaire->contenu }}</p>
                    </div>
                @endforeach
                
                @if($commentaires->hasPages())
                    <div class="mt-3">
                        {{ $commentaires->links() }}
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection