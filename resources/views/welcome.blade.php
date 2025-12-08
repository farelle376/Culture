@extends('layout')
@section('content')

        
       <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>1,247</h3>
                    <p>Utilisateurs</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-info">
                    <h3>543</h3>
                    <p>Contenus</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-info">
                    <h3>892</h3>
                    <p>Commentaires</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-photo-video"></i>
                </div>
                <div class="stat-info">
                    <h3>1,024</h3>
                    <p>Médias</p>
                </div>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">
            <!-- Utilisateurs Récents -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Utilisateurs Récents</h3>
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Koffi D.</td>
                            <td>koffi@example.bj</td>
                            <td>Contributeur</td>
                            <td><span class="status-badge status-active">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Aïcha T.</td>
                            <td>aicha@example.bj</td>
                            <td>Éditeur</td>
                            <td><span class="status-badge status-active">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Jean S.</td>
                            <td>jean@example.bj</td>
                            <td>Lecteur</td>
                            <td><span class="status-badge status-pending">En attente</span></td>
                        </tr>
                        <tr>
                            <td>Mariam D.</td>
                            <td>mariam@example.bj</td>
                            <td>Contributeur</td>
                            <td><span class="status-badge status-active">Actif</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Contenus Récents -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contenus Récents</h3>
                    <div class="card-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
                <div class="content-list">
                    <div class="content-item">
                        <div class="content-img">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="content-details">
                            <div class="content-title">Festival des Masques Guèlèdè à Savalou</div>
                            <div class="content-meta">
                                <span><i class="fas fa-user"></i> Koffi D.</span>
                                <span><i class="far fa-clock"></i> Il y a 2 heures</span>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn"><i class="fas fa-eye"></i> 245</button>
                                <button class="action-btn"><i class="fas fa-heart"></i> 34</button>
                                <button class="action-btn"><i class="fas fa-comment"></i> 12</button>
                            </div>
                        </div>
                    </div>
                    <div class="content-item">
                        <div class="content-img">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="content-details">
                            <div class="content-title">Recette Traditionnelle: Sauce Amani</div>
                            <div class="content-meta">
                                <span><i class="fas fa-user"></i> Aïcha T.</span>
                                <span><i class="far fa-clock"></i> Il y a 5 heures</span>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn"><i class="fas fa-eye"></i> 187</button>
                                <button class="action-btn"><i class="fas fa-heart"></i> 42</button>
                                <button class="action-btn"><i class="fas fa-comment"></i> 8</button>
                            </div>
                        </div>
                    </div>
                    <div class="content-item">
                        <div class="content-img">
                            <i class="fas fa-music"></i>
                        </div>
                        <div class="content-details">
                            <div class="content-title">Histoire du Rythme Tchinkounmè</div>
                            <div class="content-meta">
                                <span><i class="fas fa-user"></i> Jean S.</span>
                                <span><i class="far fa-clock"></i> Il y a 1 jour</span>
                            </div>
                            <div class="content-actions">
                                <button class="action-btn"><i class="fas fa-eye"></i> 312</button>
                                <button class="action-btn"><i class="fas fa-heart"></i> 56</button>
                                <button class="action-btn"><i class="fas fa-comment"></i> 15</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Types de Contenu -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Types de Contenu</h3>
                    <div class="card-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Nombre</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Article</td>
                            <td>245</td>
                            <td><span class="status-badge status-active">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Vidéo</td>
                            <td>128</td>
                            <td><span class="status-badge status-active">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Audio</td>
                            <td>76</td>
                            <td><span class="status-badge status-active">Actif</span></td>
                        </tr>
                        <tr>
                            <td>Galerie</td>
                            <td>94</td>
                            <td><span class="status-badge status-pending">En révision</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Commentaires Récents -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Commentaires Récents</h3>
                    <div class="card-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
                <div class="content-list">
                    <div class="content-item">
                        <div class="content-details">
                            <div class="content-title">"Super article sur les traditions!"</div>
                            <div class="content-meta">
                                <span><i class="fas fa-user"></i> Komi S.</span>
                                <span><i class="far fa-clock"></i> Il y a 30 min</span>
                            </div>
                        </div>
                    </div>
                    <div class="content-item">
                        <div class="content-details">
                            <div class="content-title">"J'adore cette recette, merci!"</div>
                            <div class="content-meta">
                                <span><i class="fas fa-user"></i> Nadia J.</span>
                                <span><i class="far fa-clock"></i> Il y a 2 heures</span>
                            </div>
                        </div>
                    </div>
                    <div class="content-item">
                        <div class="content-details">
                            <div class="content-title">"Très instructif, je partage!"</div>
                            <div class="content-meta">
                                <span><i class="fas fa-user"></i> Marcel K.</span>
                                <span><i class="far fa-clock"></i> Il y a 5 heures</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            

@endsection