@extends('layout1')

@section('css')
<style>
.edit-container {
    max-width: 500px;
    margin: 30px auto;
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.edit-title {
    text-align: center;
    color: #008751;
    margin-bottom: 25px;
    font-size: 1.5rem;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #444;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 1rem;
}

.form-control:focus {
    outline: none;
    border-color: #008751;
}

.btn {
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s;
}

.btn-primary {
    background: #008751;
    color: white;
}

.btn-primary:hover {
    background: #006b40;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.alert {
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.error-message {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 5px;
}
</style>
@endsection

@section('content')
<div class="edit-container">
    <h2 class="edit-title"><i class="fas fa-user-edit"></i> Modifier mon profil</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('modifier.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Prénom et Nom -->
        <div class="form-group">
            <label for="prenom" class="form-label">Prénom *</label>
            <input type="text" id="prenom" name="prenom" 
                   class="form-control" 
                   value="{{ old('prenom', $user->prenom) }}" 
                   required>
            @error('prenom')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nom" class="form-label">Nom *</label>
            <input type="text" id="nom" name="nom" 
                   class="form-control" 
                   value="{{ old('nom', $user->nom) }}" 
                   required>
            @error('nom')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email" class="form-label">Email *</label>
            <input type="email" id="email" name="email" 
                   class="form-control" 
                   value="{{ old('email', $user->email) }}" 
                   required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Sexe -->
        <div class="form-group">
            <label for="sexe" class="form-label">Sexe</label>
            <select id="sexe" name="sexe" class="form-control">
                <option value="">Sélectionnez...</option>
                <option value="homme" {{ old('sexe', $user->sexe) == 'homme' ? 'selected' : '' }}>Homme</option>
                <option value="femme" {{ old('sexe', $user->sexe) == 'femme' ? 'selected' : '' }}>Femme</option>
                <option value="autre" {{ old('sexe', $user->sexe) == 'autre' ? 'selected' : '' }}>Autre</option>
            </select>
            @error('sexe')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date de naissance -->
        <div class="form-group">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" id="date_naissance" name="date_naissance" 
                   class="form-control" 
                   value="{{ old('date_naissance', $user->date_naissance ? \Carbon\Carbon::parse($user->date_naissance)->format('Y-m-d') : '') }}">
            @error('date_naissance')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- Boutons -->
        <div style="display: flex; gap: 10px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Enregistrer
            </button>
            
            <a href="{{ route('front.profile') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Annuler
            </a>
        </div>
    </form>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection