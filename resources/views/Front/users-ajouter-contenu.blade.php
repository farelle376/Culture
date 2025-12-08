@extends('layout1')

@section('css')
<style>
    /* Reset des styles potentiels en conflit */
    
     .contenu-form-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .contenu-form-container .card {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .contenu-form-container .card-header {
        border-radius: 10px 10px 0 0 !important;
        background: #28a745;
        border-bottom: none;
        padding: 20px;
    }
    
    .contenu-form-container .card-header h3 {
        margin: 0;
        color: white;
        font-weight: 600;
    }
    
    .contenu-form-container .card-body {
        padding: 30px;
    }
    
    .contenu-form-container .form-label {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }
    
    .contenu-form-container .form-control, 
    .contenu-form-container .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 16px;
        transition: all 0.3s ease;
        width: 100%;
        background-color: #fff;
    }
    
    .contenu-form-container .form-control:focus, 
    .contenu-form-container .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        outline: none;
    }
    
    .contenu-form-container .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    .contenu-form-container .row > [class*="col-"] {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .contenu-form-container .form-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 5px;
    }
    
    .contenu-form-container .btn {
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .contenu-form-container .btn-primary {
        background: #28a745;
        color: white;
    }
    
    .contenu-form-container .btn-primary:hover {
        background: #28a745;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .contenu-form-container .btn-secondary {
        background: #6c757d;
        color: white;
    }
    
    .contenu-form-container .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }
    
    .contenu-form-container .btn-outline-primary {
        background: transparent;
        border: 2px solid #28a745;
        color: #28a745;
    }
    
    .contenu-form-container .btn-outline-primary:hover {
        background:#28a745;
        color: white;
    }
    
    /* Style pour l'éditeur de texte */
    .contenu-form-container #texte {
        min-height: 300px;
        resize: vertical;
        font-family: inherit;
    }
    
    /* Prévisualisation des fichiers */
    .contenu-form-container .file-preview {
        display: none;
        margin-top: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 2px dashed #dee2e6;
    }
    
    .contenu-form-container .preview-item {
        display: flex;
        align-items: center;
        padding: 12px;
        background: white;
        border-radius: 8px;
        margin-bottom: 10px;
        border: 1px solid #e9ecef;
        transition: all 0.2s ease;
    }
    
    .contenu-form-container .preview-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .contenu-form-container .preview-icon {
        width: 48px;
        height: 48px;
        background: #28a745;
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    .contenu-form-container .preview-info {
        flex: 1;
        min-width: 0;
    }
    
    .contenu-form-container .preview-name {
        font-weight: 500;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .contenu-form-container .preview-size {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .contenu-form-container .remove-file {
        background: #dc3545;
        color: white;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 10px;
        flex-shrink: 0;
        transition: all 0.2s ease;
    }
    
    .contenu-form-container .remove-file:hover {
        background: #c82333;
        transform: scale(1.1);
    }
    
    /* Messages d'erreur */
    .contenu-form-container .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }
    
    .contenu-form-container .is-invalid {
        border-color: #dc3545 !important;
    }
    
    /* Section media */
    .contenu-form-container .media-section .card {
        border: 2px solid #f8f9fa;
    }
    
    .contenu-form-container .media-section .card-header {
        background: #f8f9fa;
        color: #2c3e50;
        padding: 15px 20px;
    }
    
    .contenu-form-container .media-section .card-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    /* Conseils */
    .contenu-form-container .tips-card .card-header {
        background: #28a745;
    }
    
    .contenu-form-container .tips-card ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .contenu-form-container .tips-card li {
        margin-bottom: 8px;
        color: #495057;
    }
    
    .contenu-form-container .tips-card li:last-child {
        margin-bottom: 0;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .contenu-form-container .card-body {
            padding: 20px;
        }
        
        .contenu-form-container .btn {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .contenu-form-container .d-flex {
            flex-direction: column;
        }
        
        .contenu-form-container .d-flex > * {
            margin-bottom: 10px;
        }
    }
</style>
@endsection

@section('content')
<div class="contenu-form-container">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Ajouter un Nouveau Contenu
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        <form id="contenuForm" action="{{ route('store-contenu') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Titre -->
                            <div class="mb-4">
                                <label for="titre" class="form-label">
                                    <i class="fas fa-heading me-2"></i>Titre du Contenu *
                                </label>
                                <input type="text" 
                                       class="form-control @error('titre') is-invalid @enderror" 
                                       id="titre" 
                                       name="titre" 
                                       value="{{ old('titre') }}" 
                                       placeholder="Entrez un titre descriptif" 
                                       required>
                                <div class="form-text">Un titre accrocheur attirera plus de lecteurs.</div>
                                @error('titre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Type et Région -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="id_typeContenu" class="form-label">
                                        <i class="fas fa-tags me-2"></i>Type de Contenu *
                                    </label>
                                    <select class="form-select @error('id_typeContenu') is-invalid @enderror" 
                                            id="id_typeContenu" 
                                            name="id_typeContenu" 
                                            required>
                                        <option value="">Sélectionnez un type</option>
                                        @foreach($typesContenu as $type)
                                            <option value="{{ $type->id }}" 
                                                    {{ old('id_typeContenu') == $type->id ? 'selected' : '' }}>
                                                {{ $type->nom }}
                                                @if($type->description)
                                                    - {{ $type->description }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_typeContenu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="id_region" class="form-label">
                                        <i class="fas fa-map-marker-alt me-2"></i>Région *
                                    </label>
                                    <select class="form-select @error('id_region') is-invalid @enderror" 
                                            id="id_region" 
                                            name="id_region" 
                                            required>
                                        <option value="">Sélectionnez une région</option>
                                        @foreach($regions as $region)
                                            <option value="{{ $region->id }}" 
                                                    {{ old('id_region') == $region->id ? 'selected' : '' }}>
                                                {{ $region->nom_region }}
                                                @if($region->description)
                                                    ({{ $region->description }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_region')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Langue et Modérateur -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="id_langue" class="form-label">
                                        <i class="fas fa-language me-2"></i>Langue *
                                    </label>
                                    <select class="form-select @error('id_langue') is-invalid @enderror" 
                                            id="id_langue" 
                                            name="id_langue" 
                                            required>
                                        <option value="">Sélectionnez une langue</option>
                                        @foreach($langues as $langue)
                                            <option value="{{ $langue->id }}" 
                                                    {{ old('id_langue') == $langue->id ? 'selected' : '' }}>
                                                {{ $langue->nom_langue }}
                                                @if($langue->code)
                                                    ({{ $langue->code }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_langue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-4">
                                    <label for="id_moderateur" class="form-label">
                                        <i class="fas fa-user-shield me-2"></i>Modérateur (Optionnel)
                                    </label>
                                    <select class="form-select @error('id_moderateur') is-invalid @enderror" 
                                            id="id_moderateur" 
                                            name="id_moderateur">
                                        <option value="">Sélectionnez un modérateur</option>
                                        @foreach($moderateurs as $moderateur)
                                            <option value="{{ $moderateur->id }}" 
                                                    {{ old('id_moderateur') == $moderateur->id ? 'selected' : '' }}>
                                                {{ $moderateur->name }} 
                                                @if($moderateur->email)
                                                    ({{ $moderateur->email }})
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">Laissez vide pour une attribution automatique.</div>
                                    @error('id_moderateur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Contenu Parent -->
                            <div class="mb-4" id="parentContainer" style="display: none;">
                                <label for="parent_id" class="form-label">
                                    <i class="fas fa-reply me-2"></i>Répondre à un contenu existant
                                </label>
                                <select class="form-select @error('parent_id') is-invalid @enderror" 
                                        id="parent_id" 
                                        name="parent_id">
                                    <option value="">Sélectionnez le contenu parent</option>
                                </select>
                                <div class="form-text">Sélectionnez si ce contenu est une réponse à un autre contenu.</div>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Date -->
                            <div class="mb-4">
                                <label for="date_creation" class="form-label">
                                    <i class="fas fa-calendar-alt me-2"></i>Date de Création
                                </label>
                                <input type="datetime-local" 
                                       class="form-control @error('date_creation') is-invalid @enderror" 
                                       id="date_creation" 
                                       name="date_creation" 
                                       value="{{ old('date_creation') ?? now()->format('Y-m-d\TH:i') }}">
                                <div class="form-text">Laissez vide pour utiliser la date et l'heure actuelles.</div>
                                @error('date_creation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Contenu Principal -->
                            <div class="mb-4">
                                <label for="texte" class="form-label">
                                    <i class="fas fa-file-alt me-2"></i>Contenu *
                                </label>
                                <textarea class="form-control @error('texte') is-invalid @enderror" 
                                          id="texte" 
                                          name="texte" 
                                          rows="10" 
                                          placeholder="Rédigez votre contenu ici..." 
                                          required>{{ old('texte') }}</textarea>
                                <div class="form-text">
                                    Utilisez un langage clair et structuré. Vous pouvez ajouter des images et des vidéos ci-dessous.
                                </div>
                                @error('texte')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Section Médias -->
                            <div class="mb-4 media-section">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">
                                            <i class="fas fa-images me-2"></i>Médias (Optionnel)
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="images" class="form-label">Images</label>
                                                <input type="file" 
                                                       class="form-control" 
                                                       id="images" 
                                                       name="images[]" 
                                                       multiple 
                                                       accept="image/*">
                                                <div class="form-text">JPG, PNG, GIF - Max 5MB</div>
                                                <div id="images-preview" class="file-preview"></div>
                                            </div>
                                            
                                            <div class="col-md-4 mb-3">
                                                <label for="videos" class="form-label">Vidéos</label>
                                                <input type="file" 
                                                       class="form-control" 
                                                       id="videos" 
                                                       name="videos[]" 
                                                       multiple 
                                                       accept="video/*">
                                                <div class="form-text">MP4, AVI, MOV - Max 50MB</div>
                                                <div id="videos-preview" class="file-preview"></div>
                                            </div>
                                            
                                            <div class="col-md-4 mb-3">
                                                <label for="documents" class="form-label">Documents</label>
                                                <input type="file" 
                                                       class="form-control" 
                                                       id="documents" 
                                                       name="documents[]" 
                                                       multiple 
                                                       accept=".pdf,.doc,.docx,.txt">
                                                <div class="form-text">PDF, DOC, TXT - Max 10MB</div>
                                                <div id="documents-preview" class="file-preview"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Boutons -->
                            <div class="d-flex justify-content-between mt-4">
                               
                                
                                <div>
                                    <button type="submit" name="action" value="draft" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-save me-2"></i>Enregistrer comme brouillon
                                    </button>
                                    <button type="submit" name="action" value="submit" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-paper-plane me-2"></i>Soumettre pour validation
                                    </button>
                                     <a href="{{ route('front.users') }}" ><button class="btn btn-outline-primary me-2">
                                    <i class="fas fa-arrow-left me-2"></i>Annuler</button>
                                </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Conseils -->
                <div class="card mt-4 tips-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-lightbulb me-2"></i>Conseils pour un bon contenu
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul>
                            <li>Utilisez un titre clair et descriptif</li>
                            <li>Structurez votre contenu avec des paragraphes</li>
                            <li>Vérifiez l'orthographe et la grammaire</li>
                            <li>Ajoutez des images pertinentes pour illustrer votre propos</li>
                            <li>Respectez les droits d'auteur pour les médias utilisés</li>
                            <li>Citez vos sources lorsque nécessaire</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fonction pour vérifier si c'est un type réponse
        function checkIfReplyType() {
            const typeSelect = document.getElementById('id_typeContenu');
            const parentContainer = document.getElementById('parentContainer');
            const selectedText = typeSelect.options[typeSelect.selectedIndex].text.toLowerCase();
            
            const isReply = selectedText.includes('réponse') || 
                           selectedText.includes('commentaire') ||
                           selectedText.includes('reply') ||
                           selectedText.includes('response');
            
            parentContainer.style.display = isReply ? 'block' : 'none';
            
            if (isReply) {
                loadParentContenus();
            }
        }
        
        // Charger les contenus parents
        function loadParentContenus() {
            const parentSelect = document.getElementById('parent_id');
            parentSelect.innerHTML = '<option value="">Chargement...</option>';
            
            fetch('/api/contenus-parent')
                .then(response => response.json())
                .then(data => {
                    parentSelect.innerHTML = '<option value="">Sélectionnez le contenu parent</option>';
                    data.forEach(contenu => {
                        const option = document.createElement('option');
                        option.value = contenu.id;
                        option.textContent = contenu.titre || contenu.texte.substring(0, 50) + '...';
                        parentSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    parentSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });
        }
        
        // Écouter le changement de type
        document.getElementById('id_typeContenu').addEventListener('change', checkIfReplyType);
        checkIfReplyType();
        
        // Gestion de la prévisualisation des fichiers
        ['images', 'videos', 'documents'].forEach(inputId => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('change', function(e) {
                    const files = e.target.files;
                    const previewContainer = document.getElementById(inputId + '-preview');
                    
                    if (!files.length) {
                        previewContainer.style.display = 'none';
                        previewContainer.innerHTML = '';
                        return;
                    }
                    
                    previewContainer.innerHTML = '';
                    previewContainer.style.display = 'block';
                    
                    Array.from(files).forEach((file, index) => {
                        const item = createPreviewItem(file, index, inputId);
                        previewContainer.appendChild(item);
                    });
                });
            }
        });
        
        function createPreviewItem(file, index, inputId) {
            const item = document.createElement('div');
            item.className = 'preview-item';
            
            // Icône
            const icon = document.createElement('div');
            icon.className = 'preview-icon';
            
            let iconClass = 'fas fa-file';
            if (file.type.startsWith('image/')) iconClass = 'fas fa-image';
            else if (file.type.startsWith('video/')) iconClass = 'fas fa-video';
            else if (file.type.includes('pdf')) iconClass = 'fas fa-file-pdf';
            else if (file.type.includes('document') || /\.docx?$/i.test(file.name)) iconClass = 'fas fa-file-word';
            else if (file.type.includes('text') || /\.txt$/i.test(file.name)) iconClass = 'fas fa-file-alt';
            
            icon.innerHTML = `<i class="${iconClass}"></i>`;
            
            // Info
            const info = document.createElement('div');
            info.className = 'preview-info';
            
            const name = document.createElement('div');
            name.className = 'preview-name';
            name.title = file.name;
            name.textContent = file.name.length > 25 ? file.name.substring(0, 25) + '...' : file.name;
            
            const size = document.createElement('div');
            size.className = 'preview-size';
            size.textContent = formatFileSize(file.size);
            
            info.appendChild(name);
            info.appendChild(size);
            
            // Bouton suppression
            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-file';
            removeBtn.type = 'button';
            removeBtn.innerHTML = '<i class="fas fa-times"></i>';
            removeBtn.onclick = function() {
                removeFileFromInput(inputId, index);
                item.remove();
                
                const container = document.getElementById(inputId + '-preview');
                if (container.children.length === 0) {
                    container.style.display = 'none';
                }
            };
            
            item.appendChild(icon);
            item.appendChild(info);
            item.appendChild(removeBtn);
            
            return item;
        }
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        function removeFileFromInput(inputId, index) {
            const input = document.getElementById(inputId);
            const files = Array.from(input.files);
            files.splice(index, 1);
            
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }
        
        // Validation
        const form = document.getElementById('contenuForm');
        form.addEventListener('submit', function(e) {
            const texte = document.getElementById('texte').value.trim();
            if (texte.length < 10) {
                e.preventDefault();
                alert('Le contenu doit contenir au moins 10 caractères.');
                document.getElementById('texte').focus();
                return false;
            }
            
            const maxSizes = {
                'images': 5 * 1024 * 1024,
                'videos': 50 * 1024 * 1024,
                'documents': 10 * 1024 * 1024
            };
            
            let hasError = false;
            ['images', 'videos', 'documents'].forEach(inputId => {
                const input = document.getElementById(inputId);
                if (input && input.files.length > 0) {
                    Array.from(input.files).forEach(file => {
                        if (file.size > maxSizes[inputId]) {
                            hasError = true;
                            alert(`"${file.name}" dépasse la taille maximale (${formatFileSize(maxSizes[inputId])})`);
                        }
                    });
                }
            });
            
            if (hasError) {
                e.preventDefault();
            }
        });
        
        // Auto-sauvegarde
        let autoSaveTimer;
        const textarea = document.getElementById('texte');
        const titleInput = document.getElementById('titre');
        
        function saveDraft() {
            const formData = new FormData();
            formData.append('titre', titleInput.value);
            formData.append('texte', textarea.value);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            
            fetch('/api/contenus/draft', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Brouillon sauvegardé');
                }
            })
            .catch(error => console.error('Erreur:', error));
        }
        
        [textarea, titleInput].forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimer);
                if (this.value.trim().length > 0) {
                    autoSaveTimer = setTimeout(saveDraft, 5000);
                }
            });
        });
    });
</script>
@endsection