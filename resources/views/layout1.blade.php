<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"></html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="{{ URL::asset('adminlte/css1/layout4.css') }}">
 @yield('css')
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="logo">
                 <img src="{{ URL::asset('adminlte/img/img8.png') }}" alt="Logo Culture Bénin">
                <a href="{{route('front.users') }}"><h1>Culture Bénin</h1></a>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('mes-contenus') }}"> Mes contenus</a></li>
                    <li><a href="{{route('region') }}">Régions</a></li>
                    <li><a href="{{route('langue') }}">Langues</a></li>
                     <li><a href="{{route('front.apropos') }}">A propos</a></li>
                    
                </ul>
            </nav>
            <div class="user-menu">
                <div class="user-avatar" onclick="toggleUserMenu()">
                {{ strtoupper(substr(Auth::user()->nom, 0, 1)) }}
                </div>
                <div classe="user-name">
                     {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                </div>
               <a href="{{route('ajouter-contenu') }}"><button class="btn btn-primary" >
                    <span>Créer</span>
                </button></a>
                <div class="user-dropdown" id="userDropdown" style="display: none; margin-top:30px; position: absolute; background: white; padding: 1rem; border-radius: 4px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-top: 10px; right: 5%;">
                    <a href="{{route('front.profile') }}"><button class="bouton" >Mon Profile</button></a>
                    <br>
                    <form method="POST" action="{{ route('logoute') }}">
            @csrf
            <button type="submit" class="bouton">Se déconnecter</button>
        </form>
                </div>
            </div>
        </div>
    </header>

   @yield('content')

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Culture Bénin</h3>
                <p>Plateforme numérique pour la promotion de la culture et des langues du Bénin.</p>
            </div>
            <div class="footer-section">
                <h3>Liens rapides</h3>
                <ul>
                    <li><a href="#accueil">Accueil</a></li>
                    <li><a href="#contenus">Contenus</a></li>
                    <li><a href="#regions">Régions</a></li>
                    <li><a href="#creation">Créer</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <ul>
                    <li>Email: contact@culturebenin.bj</li>
                    <li>Téléphone: +229 XX XX XX XX</li>
                    <li>Adresse: Cotonou, Bénin</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 Plateforme Culturelle du Bénin. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Content Details Modal -->
    <div id="contentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeContentModal()">&times;</span>
            <div id="modalContent">
                <!-- Content will be loaded here dynamically -->
            </div>
        </div>
    </div>
@yield('script')
    <script>
        // User menu toggle
        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Close user menu when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const avatar = document.querySelector('.user-avatar');
            if (!avatar.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Scroll to section
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
        }

        // Category filtering
        document.querySelectorAll('.category-filter').forEach(filter => {
            filter.addEventListener('click', function() {
                // Update active filter
                document.querySelectorAll('.category-filter').forEach(f => f.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.getAttribute('data-category');
                const contentCards = document.querySelectorAll('.content-card');
                
                contentCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Content creation form submission
        document.getElementById('contentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const title = document.getElementById('contentTitle').value;
            const type = document.getElementById('contentType').value;
            const region = document.getElementById('contentRegion').value;
            const language = document.getElementById('contentLanguage').value;
            
            // Here you would typically send the data to your backend
            alert(`Contenu "${title}" créé avec succès! Il sera soumis à modération.`);
            
            // Reset form
            this.reset();
        });

        // View content details
        function viewContentDetails(contentId) {
            // In a real application, you would fetch content details from your backend
            const contentData = {
                1: {
                    title: "Le Conte d'Akpakpa et la Sagesse",
                    type: "Histoire",
                    region: "Zou",
                    language: "Fon",
                    description: "Un récit traditionnel fon sur les origines de la sagesse et la valeur de l'expérience dans la communauté.",
                    body: "Il était une fois, dans un village du Zou, un jeune homme nommé Akpakpa qui cherchait à acquérir la sagesse. Il parcourut tout le pays, interrogeant les anciens et apprenant de chaque expérience. Finalement, il comprit que la vraie sagesse ne vient pas de l'âge mais de l'écoute et du respect des autres.",
                    rating: 4.2,
                    comments: [
                        { author: "Koffi A.", date: "2023-10-15", text: "J'ai grandi avec cette histoire! Merci de la partager." },
                        { author: "Aïcha D.", date: "2023-10-12", text: "Belle morale. Je vais la raconter à mes enfants." },
                        { author: "Moussa K.", date: "2023-10-10", text: "Très belle histoire qui rappelle l'importance des anciens dans notre culture." }
                    ]
                },
                2: {
                    title: "Recette d'Akassa",
                    type: "Recette",
                    region: "Atlantique",
                    language: "Goun",
                    description: "Préparation de l'akassa, pâte de maïs fermentée servie avec une sauce graine ou d'autres accompagnements.",
                    body: "Ingrédients:\n- 500g de farine de maïs\n- Eau\n- Sel\n\nPréparation:\n1. Mélanger la farine de maïs avec de l'eau\n2. Laisser fermenter pendant 24h\n3. Cuire à feu doux en remuant constamment\n4. Servir avec une sauce de votre choix",
                    rating: 3.5,
                    comments: [
                        { author: "Marc T.", date: "2023-10-18", text: "J'ai essayé cette recette, c'était délicieux!" },
                        { author: "Fatou B.", date: "2023-10-16", text: "Dans ma famille, on ajoute un peu de piment pour plus de goût." }
                    ]
                },
                3: {
                    title: "La Danse Gèlèdè",
                    type: "Article",
                    region: "Plateau",
                    language: "Yoruba",
                    description: "Origines et significations de la danse masquée Gèlèdè, patrimoine culturel immatériel de l'UNESCO.",
                    body: "La danse Gèlèdè est une tradition yoruba qui remonte au XVIIIe siècle. Elle est pratiquée pour honorer les mères, considérées comme les dépositaires de la vie et de la moralité. Les masques utilisés dans cette danse représentent souvent des animaux ou des figures mythiques et sont portés lors de cérémonies qui combinent danse, musique et théâtre.",
                    rating: 4.8,
                    comments: [
                        { author: "Jean P.", date: "2023-10-20", text: "Article très instructif sur une tradition fascinante." },
                        { author: "Sofia M.", date: "2023-10-19", text: "J'ai eu la chance d'assister à une cérémonie Gèlèdè, c'était magique!" }
                    ]
                }
            };
            
            const content = contentData[contentId];
            if (!content) return;
            
            // Build modal content
            let modalHTML = `
                <h2>${content.title}</h2>
                <div class="content-meta" style="margin: 1rem 0;">
                    <span>Type: ${content.type} | Région: ${content.region}</span>
                    <div class="content-language">${content.language}</div>
                </div>
                
                <div class="rating" style="margin: 1rem 0;">
                    <div class="stars">
                        ${generateStars(content.rating)}
                    </div>
                    <span class="rating-value">${content.rating}</span>
                </div>
                
                <h3>Description</h3>
                <p>${content.description}</p>
                
                <h3>Contenu</h3>
                <div style="white-space: pre-line; background: var(--light-bg); padding: 1rem; border-radius: 4px;">
                    ${content.body}
                </div>
                
                <div class="comments-section">
                    <h3>Commentaires (${content.comments.length})</h3>
            `;
            
            // Add comments
            content.comments.forEach(comment => {
                modalHTML += `
                    <div class="comment">
                        <div class="comment-header">
                            <span class="comment-author">${comment.author}</span>
                            <span class="comment-date">${comment.date}</span>
                        </div>
                        <p>${comment.text}</p>
                    </div>
                `;
            });
            
            // Add comment form
            modalHTML += `
                    <div class="comment-form">
                        <h4>Ajouter un commentaire</h4>
                        <textarea placeholder="Votre commentaire..." id="commentText"></textarea>
                        <button class="btn btn-primary" onclick="addComment(${contentId})">Publier le commentaire</button>
                    </div>
                </div>
                
                <div style="margin-top: 2rem;">
                    <h4>Noter ce contenu</h4>
                    <div class="rating">
                        <div class="stars" id="ratingStars">
                            <span class="star" data-rating="1">★</span>
                            <span class="star" data-rating="2">★</span>
                            <span class="star" data-rating="3">★</span>
                            <span class="star" data-rating="4">★</span>
                            <span class="star" data-rating="5">★</span>
                        </div>
                        <span class="rating-value" id="currentRating">${content.rating}</span>
                    </div>
                </div>
            `;
            
            document.getElementById('modalContent').innerHTML = modalHTML;
            document.getElementById('contentModal').style.display = 'flex';
            
            // Add star rating interaction
            document.querySelectorAll('#ratingStars .star').forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    updateStarRating(contentId, rating);
                });
                
                star.addEventListener('mouseover', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    highlightStars(rating);
                });
            });
            
            document.getElementById('ratingStars').addEventListener('mouseleave', function() {
                const currentRating = parseFloat(document.getElementById('currentRating').textContent);
                highlightStars(Math.round(currentRating));
            });
            
            // Highlight current rating
            highlightStars(Math.round(content.rating));
        }
        
        function closeContentModal() {
            document.getElementById('contentModal').style.display = 'none';
        }
        
        function generateStars(rating) {
            let stars = '';
            const fullStars = Math.floor(rating);
            const hasHalfStar = rating % 1 >= 0.5;
            
            for (let i = 1; i <= 5; i++) {
                if (i <= fullStars) {
                    stars += '<span class="star active">★</span>';
                } else if (i === fullStars + 1 && hasHalfStar) {
                    stars += '<span class="star active">★</span>';
                } else {
                    stars += '<span class="star">★</span>';
                }
            }
            
            return stars;
        }
        
        function updateStarRating(contentId, rating) {
            document.getElementById('currentRating').textContent = rating;
            highlightStars(rating);
            // Here you would typically send the rating to your backend
            alert(`Merci pour votre note de ${rating} étoiles pour le contenu ${contentId}!`);
        }
        
        function highlightStars(count) {
            const stars = document.querySelectorAll('#ratingStars .star');
            stars.forEach((star, index) => {
                if (index < count) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }
        
        function addComment(contentId) {
            const commentText = document.getElementById('commentText').value;
            if (!commentText.trim()) {
                alert('Veuillez écrire un commentaire');
                return;
            }
            
            // Here you would typically send the comment to your backend
            alert(`Commentaire ajouté pour le contenu ${contentId}: "${commentText}"`);
            document.getElementById('commentText').value = '';
        }
        
        function logout() {
            if(confirm('Êtes-vous sûr de vouloir vous déconnecter?')) {
                // Here you would typically clear the user session and redirect to login
                alert('Déconnexion réussie');
                window.location.href = 'index.html'; // Redirect to public homepage
            }
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('contentModal');
            if (event.target === modal) {
                closeContentModal();
            }
        }
         document.querySelectorAll('.btn-lecture').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault(); // Empêche le comportement précédent
        openSubscriptionModal();
    });
});

document.querySelectorAll('.btn-lecture').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault(); // Empêche le comportement précédent
        openSubscriptionModal();
    });
});

function openSubscriptionModal() {
    document.getElementById('subscriptionModal').style.display = 'flex';
}

function closeSubscriptionModal() {
    document.getElementById('subscriptionModal').style.display = 'none';
}

function subscribe() {
    // Ici tu peux rediriger vers ta page paiement/abonnement
    alert("Redirection vers la page d'abonnement...");
    window.location.href = "/abonnement"; // Modifier avec ton URL
}

// Fermer modal si clic en dehors
window.onclick = function(event) {
    const modal = document.getElementById('subscriptionModal');
    if (event.target === modal) {
        closeSubscriptionModal();
    }
};

</script>
    
   <div id="subscriptionModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeSubscriptionModal()">&times;</span>
        <h2>Accès réservé</h2>
        <p>Veuillez vous connecter ou créer un compte</p>
    <a href="{{ route('front.inscrit') }}">
    <button class="btn btn-outline" >
        Se Connecter
    </button></a>

        <button class="btn btn-outline" onclick="closeSubscriptionModal()">Annuler</button>
    </div>
</div>


</body>
</html>