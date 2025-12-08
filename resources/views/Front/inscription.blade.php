@extends('layouts')

@section('css')
<style>
/* ===== Page container ===== */
.register-page {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f3f4f6;
    padding: 20px;
}

/* ===== Card formulaire ===== */
.card {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    max-width: 750px;
    width: 100%;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    border: 3px solid green;
}

/* Titre */
.page-title {
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 25px;
    font-weight: 600;
    color: #333;
}

/* ===== Photo de profil ===== */
.profile-photo-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e5e7eb;
}

.photo-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #008751;
    margin-bottom: 15px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.photo-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.photo-preview .placeholder {
    font-size: 40px;
    color: #9ca3af;
}

.photo-upload {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.photo-label {
    background: #008751;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: 500;
    transition: background 0.3s;
}

.photo-label:hover {
    background: #006b40;
}

.photo-input {
    display: none;
}

.file-name {
    font-size: 0.85rem;
    color: #6b7280;
    text-align: center;
    max-width: 200px;
    word-break: break-all;
}

.file-requirements {
    font-size: 0.8rem;
    color: #9ca3af;
    margin-top: 5px;
}

/* ===== Formulaire ===== */
.form-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-groups {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}

.form-groups input {
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    outline: none;
    font-size: 0.95rem;
    width: 100%;
}

label {
    font-size: 0.9rem;
    margin-bottom: 5px;
    color: #333;
    font-weight: 500;
}

input, select {
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    outline: none;
    font-size: 0.95rem;
    width: 100%;
}

input:focus, select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.18);
}

/* Button */
.btn-primary {
    width: 100%;
    background: #008751;
    color: white;
    padding: 12px;
    border-radius: 8px;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
    margin-top: 10px;
}

.btn-primary:hover {
    background: #006b40;
}

/* Responsive */
@media(max-width: 768px){
    .form-row {
        flex-direction: column;
        gap: 15px;
    }
    
    .card {
        padding: 20px;
    }
    
    .photo-preview {
        width: 100px;
        height: 100px;
    }
}
</style>
@endsection

@section('content')
<br><br><br><br><br>
<div class="register-page">
    <div class="card">
        <h2 class="page-title">Créer un compte</h2>

        <form method="POST" action="{{ route('front.inscription.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Section Photo de profil -->
            <div class="profile-photo-section">
                <div class="photo-preview" id="photoPreview">
                    <div class="placeholder">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
                
                <div class="photo-upload">
                    <label for="photoProfil" class="photo-label">
                        <i class="fas fa-camera"></i> Choisir une photo
                    </label>
                    <input type="file" id="photoProfil" name="photo_profil" class="photo-input" accept="image/*">
                    <div class="file-name" id="fileName">Aucun fichier choisi</div>
                    <div class="file-requirements">JPG, PNG, GIF (max 2MB)</div>
                </div>
            </div>

            <!-- Informations personnelles -->
            <div class="form-row">
                <div class="form-group">
                    <label>Nom *</label>
                    <input type="text" name="nom" required>
                </div>
                <div class="form-group">
                    <label>Prénom *</label>
                    <input type="text" name="prenom" required>
                </div>
            </div>

            <div class="form-groups">
                <label>Email *</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Date de naissance *</label>
                    <input type="date" name="date_naissance" required>
                </div>
                <div class="form-group">
                    <label>Sexe *</label>
                    <select name="sexe" required>
                        <option value="">Sélectionner</option>
                        <option value="feminin">Féminin</option>
                        <option value="masculin">Masculin</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Mot de passe *</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Langue *</label>
                    <select name="id_langue" required>
                        <option value="">Choisir une langue</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue->id }}">{{ $langue->nom_langue }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-primary">S'inscrire</button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('photoProfil');
    const photoPreview = document.getElementById('photoPreview');
    const fileName = document.getElementById('fileName');

    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Afficher le nom du fichier
            fileName.textContent = file.name;
            
            // Vérifier la taille du fichier (max 2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. Maximum 2MB autorisé.');
                photoInput.value = '';
                fileName.textContent = 'Aucun fichier choisi';
                return;
            }
            
            // Prévisualiser l'image
            const reader = new FileReader();
            reader.onload = function(e) {
                // Vider le contenu du preview
                photoPreview.innerHTML = '';
                
                // Créer et ajouter l'image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Photo de profil';
                photoPreview.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            fileName.textContent = 'Aucun fichier choisi';
            // Réinitialiser la prévisualisation
            photoPreview.innerHTML = '<div class="placeholder"><i class="fas fa-user-circle"></i></div>';
        }
    });
});
</script>

<!-- Ajout de FontAwesome pour l'icône -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection