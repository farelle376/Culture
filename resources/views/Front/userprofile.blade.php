@extends('layout1')

@section('css')
<style>
.profile-container {
    max-width: 650px;
    margin: auto;
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.profile-header {
    text-align: center;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: auto;
    background-size: cover;
    background-position: center;
    border: 4px solid #eee;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 48px;
    color: #008751;
    background-color: #f0f7f4;
    overflow: hidden;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    font-size: 2.5rem;
    font-weight: bold;
}

.profile-name {
    font-size: 1.5rem;
    margin-top: 15px;
    font-weight: bold;
}

.profile-email {
    color: #666;
    margin-bottom: 15px;
}

.profile-badges {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.badge {
    background: #008751;
    color: white;
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 0.8rem;
}

.badge-secondary {
    background: #6c757d;
}

.badge-tertiary {
    background: #17a2b8;
}

.profile-section {
    margin-top: 25px;
}

.section-title {
    font-weight: bold;
    margin-bottom: 8px;
    font-size: 1rem;
    color: #444;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-box {
    background: #fafafa;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #eee;
}

.info-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.info-label {
    color: #666;
    font-weight: 500;
}

.info-value {
    color: #333;
    font-weight: 500;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-top: 10px;
}

.stat-card {
    background: white;
    padding: 15px;
    border-radius: 8px;
    text-align: center;
    border: 1px solid #e5e7eb;
}

.stat-number {
    font-size: 1.8rem;
    font-weight: bold;
    color: #008751;
    display: block;
}

.stat-label {
    font-size: 0.9rem;
    color: #666;
    margin-top: 5px;
}

.profile-buttons {
    margin-top: 30px;
    text-align: center;
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    padding: 10px 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.btn-primary {
    background: #008751;
    color: white;
}

.btn-primary:hover {
    background: #006b40;
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    border: 1px solid #008751;
    color: #008751;
}

.btn-outline:hover {
    background: #008751;
    color: white;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.no-data {
    color: #999;
    font-style: italic;
    text-align: center;
    padding: 20px 0;
}

/* Responsive */
@media (max-width: 768px) {
    .profile-container {
        padding: 15px;
        margin: 15px;
    }
    
    .profile-badges {
        flex-direction: column;
        align-items: center;
    }
    
    .profile-buttons {
        flex-direction: column;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@section('content')
<div class="profile-container">
    @auth
        @php
            $user = Auth::user();
            // S'assurer que c'est un Utilisateur
            if (!$user instanceof \App\Models\Utilisateur) {
                $user = \App\Models\Utilisateur::find(Auth::id());
            }
        @endphp
        
        @if($user)
            <!-- Avatar + Nom -->
            <div class="profile-header">
                <div class="profile-avatar">
                    @if($user->photo_profil)
                        @if(file_exists(public_path('storage/' . $user->photo_profil)))
                            <img src="{{ asset('storage/' . $user->photo_profil) }}" 
                                 alt="{{ $user->prenom }} {{ $user->nom }}">
                        @elseif(filter_var($user->photo_profil, FILTER_VALIDATE_URL))
                            <img src="{{ $user->photo_profil }}" 
                                 alt="{{ $user->prenom }} {{ $user->nom }}">
                        @else
                            <div class="avatar-placeholder">
                                {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                            </div>
                        @endif
                    @else
                        <div class="avatar-placeholder">
                            {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="profile-name">{{ $user->prenom }} {{ $user->nom }}</div>
                <div class="profile-email">{{ $user->email }}</div>

                <!-- Badges -->
                <div class="profile-badges">
                    @if($user->langue)
                        <div class="badge">Langue : {{ $user->langue->nom_langue }}</div>
                    @endif
                    
                    @if($user->date_naissance)
                        <div class="badge badge-secondary">
                            Âge : {{ \Carbon\Carbon::parse($user->date_naissance)->age }} ans
                        </div>
                    @endif
                    
                    <div class="badge badge-tertiary">
                        Sexe : {{ ucfirst($user->sexe) }}
                    </div>
                </div>
            </div>

            <!-- Section Informations personnelles -->
            <div class="profile-section">
                <div class="section-title">Informations personnelles</div>
                <div class="section-box">
                    <div class="info-item">
                        <span class="info-label">Nom complet :</span>
                        <span class="info-value">{{ $user->prenom }} {{ $user->nom }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email :</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                    @if($user->date_naissance)
                    <div class="info-item">
                        <span class="info-label">Date de naissance :</span>
                        <span class="info-value">
                            {{ \Carbon\Carbon::parse($user->date_naissance)->format('d/m/Y') }}
                        </span>
                    </div>
                    @endif
                    <div class="info-item">
                        <span class="info-label">Sexe :</span>
                        <span class="info-value">{{ ucfirst($user->sexe) }}</span>
                    </div>
                    @if($user->langue)
                    <div class="info-item">
                        <span class="info-label">Langue préférée :</span>
                        <span class="info-value">{{ $user->langue->nom_langue }}</span>
                    </div>
                    @endif
                    <div class="info-item">
                        <span class="info-label">Membre depuis :</span>
                        <span class="info-value">
                            {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Section Biographie -->
            <div class="profile-section">
                <div class="section-title">
                    <span>Biographie</span>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">
                        <i class="fas fa-edit"></i> Éditer
                    </a>
                </div>
                <div class="section-box">
                    @if($user->biographie)
                        <p style="white-space: pre-line;">{{ $user->biographie }}</p>
                    @else
                        <div class="no-data">
                            <p>Aucune biographie disponible</p>
                            <small>Ajoutez une description pour que les autres utilisateurs vous connaissent mieux</small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Section Statistiques SIMPLIFIÉE -->
            <div class="profile-section">
                <div class="section-title">Mes statistiques</div>
                <div class="section-box">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <span class="stat-number">{{ $contenusCount }}</span>
                            <span class="stat-label">Contenus créés</span>
                        </div>
                        <div class="stat-card">
                            <span class="stat-number">
                                {{ \Carbon\Carbon::parse($user->created_at)->diffInDays(\Carbon\Carbon::now()) }}
                            </span>
                            <span class="stat-label">Jours de membre</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="profile-buttons">
                @if($contenusCount > 0)
                <a href="{{ route('mes-contenus') }}" class="btn btn-secondary">
                    <i class="fas fa-file-alt"></i> Voir mes contenus ({{ $contenusCount }})
                </a>
                @else
                <a href="{{ route('ajouter-contenu') }}" class="btn btn-secondary">
                    <i class="fas fa-plus"></i> Créer mon premier contenu
                </a>
                @endif
                
                <a href="{{ route('modifier') }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Modifier mon profil
                </a>
                
                <form method="POST" action="{{ route('logoute') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline">
                        <i class="fas fa-sign-out-alt"></i> Se déconnecter
                    </button>
                </form>
            </div>
        @else
            <div class="no-data">
                <p>Utilisateur non trouvé</p>
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </a>
            </div>
        @endif
    @else
        <div class="no-data">
            <p>Veuillez vous connecter pour voir votre profil</p>
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </a>
        </div>
    @endauth
</div>

<!-- Ajout des icônes FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
// Confirmation pour la déconnexion
document.addEventListener('DOMContentLoaded', function() {
    const logoutForm = document.querySelector('form[action*="logout"] button');
    if (logoutForm) {
        logoutForm.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir vous déconnecter ?')) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endsection