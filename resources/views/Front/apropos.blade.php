@extends('layouts')
@section('content')
@section('css')
<style>
/* Hero Section */
        .about-hero {
            background: linear-gradient(135deg, var(--primary-color), #006b40);
            color: white;
            padding: 6rem 1rem;
            text-align: center;
        }
        
        .about-hero-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .about-hero h1 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .about-hero p {
            font-size: 1.3rem;
            line-height: 1.6;
            opacity: 0.9;
        }
        
        /* Mission Section */
        .mission {
            padding: 5rem 1rem;
            background: white;
        }
        
        .mission-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        .mission-content h2 {
            color: var(--primary-color);
            margin-bottom: 2rem;
            font-size: 2.2rem;
        }
        
        .mission-text {
            line-height: 1.8;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .mission-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #666;
            font-weight: 500;
        }
        
        .mission-image {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .mission-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        /* Values Section */
        .values {
            padding: 5rem 1rem;
            background: var(--light-bg);
        }
        
        .values-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            color: var(--primary-color);
            position: relative;
        }
        
        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
            margin: 0.5rem auto;
        }
        
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .value-card {
            background: white;
            padding: 2.5rem;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        
        .value-card:hover {
            transform: translateY(-5px);
        }
        
        .value-icon {
            width: 80px;
            height: 80px;
            background: var(--light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
        }
        
        .value-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        /* Team Section */
        .team {
            padding: 5rem 1rem;
            background: white;
        }
        
        .team-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .team-member {
            text-align: center;
        }
        
        .member-photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            overflow: hidden;
            border: 4px solid var(--light-bg);
        }
        
        .member-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .member-info h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .member-role {
            color: var(--accent-color);
            font-weight: 500;
            margin-bottom: 1rem;
        }
        
        .member-bio {
            color: #666;
            line-height: 1.6;
        }
        
        /* Partners Section */
        .partners {
            padding: 5rem 1rem;
            background: var(--light-bg);
        }
        
        .partners-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            align-items: center;
        }
        
        .partner-logo {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 120px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }
        
        .partner-logo img {
            max-width: 100%;
            max-height: 60px;
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        
        .partner-logo:hover img {
            opacity: 1;
        }
        
        /* Timeline Section */
        .timeline {
            padding: 5rem 1rem;
            background: white;
        }
        
        .timeline-container {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }
        
        .timeline-container:before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--primary-color);
            transform: translateX(-50%);
        }
        
        .timeline-item {
            margin-bottom: 3rem;
            position: relative;
            width: 45%;
        }
        
        .timeline-item:nth-child(odd) {
            left: 0;
        }
        
        .timeline-item:nth-child(even) {
            left: 55%;
        }
        
        .timeline-content {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            border-left: 4px solid var(--primary-color);
        }
        
        .timeline-year {
            background: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 1rem;
        }
        
        /* Contact Section */
        .contact {
            padding: 5rem 1rem;
            background: linear-gradient(135deg, var(--primary-color), #006b40);
            color: white;
        }
        
        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }
        
        .contact-info h2 {
            margin-bottom: 2rem;
        }
        
        .contact-details {
            margin-bottom: 2rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            color: var(--text-color);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        /* Footer */
        footer {
            background-color: #222;
            color: white;
            padding: 3rem 1rem 1rem;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .footer-section h3 {
            margin-bottom: 1rem;
            color: var(--secondary-color);
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section li {
            margin-bottom: 0.5rem;
        }
        
        .footer-section a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: var(--secondary-color);
        }
        
        .copyright {
            text-align: center;
            margin-top: 3rem;
            padding-top: 1rem;
            border-top: 1px solid #444;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            nav ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .mission-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .mission-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .contact-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .timeline-container:before {
                left: 30px;
            }
            
            .timeline-item {
                width: 100%;
                left: 0 !important;
                padding-left: 60px;
            }
            
            .about-hero h1 {
                font-size: 2.5rem;
            }
        }
</style>
@endsection
  <!-- Hero Section -->
    <section class="about-hero">
        <div class="about-hero-content">
            <h1>À Propos de Culture Bénin</h1>
            <p>Découvrez la mission, les valeurs et l'équipe derrière la plateforme dédiée à la préservation et la promotion du patrimoine culturel béninois.</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission">
        <div class="mission-container">
            <div class="mission-content">
                <h2>Notre Mission</h2>
                <p class="mission-text">
                    Culture Bénin est une plateforme numérique innovante créée pour documenter, valoriser et diffuser la richesse culturelle du Bénin. 
                    Nous œuvrons pour la préservation du patrimoine immatériel et la promotion des langues nationales comme vecteurs essentiels de transmission du savoir.
                </p>
                <p class="mission-text">
                    Notre objectif est de créer une communauté dynamique où chaque Béninois peut contribuer à enrichir notre héritage culturel commun 
                    et où le monde entier peut découvrir la diversité exceptionnelle de nos traditions.
                </p>
                <div class="mission-stats">
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Contenus culturels</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Langues représentées</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">1,000+</div>
                        <div class="stat-label">Contributeurs</div>
                    </div>
                </div>
            </div>
            <div class="mission-image">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Culture Bénin">
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values">
        <div class="values-container">
            <h2 class="section-title">Nos Valeurs</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">🌍</div>
                    <h3>Patrimoine</h3>
                    <p>Préserver et valoriser l'héritage culturel béninois pour les générations futures.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Communauté</h3>
                    <p>Créer un espace participatif où chaque voix compte et peut contribuer.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🔊</div>
                    <h3>Inclusion</h3>
                    <p>Donner une place à toutes les langues et cultures du Bénin sans exception.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">💡</div>
                    <h3>Innovation</h3>
                    <p>Utiliser la technologie pour moderniser la transmission des savoirs traditionnels.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🎯</div>
                    <h3>Authenticité</h3>
                    <p>Garantir l'authenticité et la véracité des contenus culturels partagés.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🌱</div>
                    <h3>Durabilité</h3>
                    <p>Assurer la pérennité des traditions dans un monde en mutation.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team">
        <div class="team-container">
            <h2 class="section-title">Notre Équipe</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Directeur">
                    </div>
                    <div class="member-info">
                        <h3>Dr. Koffi Mensah</h3>
                        <div class="member-role">Directeur du Projet</div>
                        <p class="member-bio">Anthropologue et expert en patrimoine culturel avec 15 ans d'expérience.</p>
                    </div>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Coordinatrice">
                    </div>
                    <div class="member-info">
                        <h3>Fatou Bello</h3>
                        <div class="member-role">Coordinatrice Culturelle</div>
                        <p class="member-bio">Spécialiste des langues nationales et traditions orales.</p>
                    </div>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Tech Lead">
                    </div>
                    <div class="member-info">
                        <h3>Jean Adjamonsi</h3>
                        <div class="member-role">Responsable Technologique</div>
                        <p class="member-bio">Développeur passionné par les solutions numériques au service de la culture.</p>
                    </div>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Modératrice">
                    </div>
                    <div class="member-info">
                        <h3>Aïcha Diallo</h3>
                        <div class="member-role">Chef Modératrice</div>
                        <p class="member-bio">Garant de la qualité et de l'authenticité des contenus partagés.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="timeline">
        <div class="timeline-container">
            <h2 class="section-title">Notre Histoire</h2>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2021</div>
                    <h3>Naissance du Projet</h3>
                    <p>Identification du besoin de préserver le patrimoine culturel béninois face à la digitalisation.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2022</div>
                    <h3>Phase de Recherche</h3>
                    <p>Étude approfondie des besoins des communautés et conception de la plateforme.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2023</div>
                    <h3>Lancement Officiel</h3>
                    <p>Mise en ligne de la plateforme avec les premières contributions communautaires.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-content">
                    <div class="timeline-year">2024</div>
                    <h3>Expansion</h3>
                    <p>Intégration de nouvelles fonctionnalités et partenariats avec les institutions culturelles.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners">
        <div class="partners-container">
            <h2 class="section-title">Nos Partenaires</h2>
            <div class="partners-grid">
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x60/008751/FFFFFF?text=MINCULTURE" alt="Ministère de la Culture">
                </div>
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x60/008751/FFFFFF?text=UNESCO" alt="UNESCO">
                </div>
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x60/008751/FFFFFF?text=UNIVERSITÉ" alt="Université d'Abomey-Calavi">
                </div>
                <div class="partner-logo">
                    <img src="https://via.placeholder.com/150x60/008751/FFFFFF?text=ONG+CULTURE" alt="ONG Culture et Développement">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact">
        <div class="contact-container">
            <div class="contact-info">
                <h2>Contactez-Nous</h2>
                <div class="contact-details">
                    <div class="contact-item">
                        <span>📍</span>
                        <div>
                            <strong>Adresse</strong><br>
                            Rue de la Culture, Cotonou<br>
                            Bénin
                        </div>
                    </div>
                    <div class="contact-item">
                        <span>📧</span>
                        <div>
                            <strong>Email</strong><br>
                            contact@culturebenin.bj
                        </div>
                    </div>
                    <div class="contact-item">
                        <span>📞</span>
                        <div>
                            <strong>Téléphone</strong><br>
                            +229 XX XX XX XX
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <h3 style="color: var(--primary-color); margin-bottom: 1.5rem;">Envoyez-nous un message</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Nom complet</label>
                        <input type="text" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Sujet</label>
                        <input type="text" id="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Envoyer le message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
       
        
        
   