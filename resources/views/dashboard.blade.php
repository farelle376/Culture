<x-app-layout>
@section('content')

        
         <div class="quick-actions">
                <div class="action-card">
                    <div class="action-icon">📝</div>
                    <h3>Nouveau Contenu</h3>
                    <p>Ajouter un contenu culturel</p>
                </div>
                <div class="action-card">
                    <div class="action-icon">👥</div>
                    <h3>Gérer Utilisateurs</h3>
                    <p>Voir tous les utilisateurs</p>
                </div>
                <div class="action-card">
                    <div class="action-icon">📋</div>
                    <h3>Modération</h3>
                    <p>Contenus en attente</p>
                </div>
                <div class="action-card">
                    <div class="action-icon">📊</div>
                    <h3>Rapports</h3>
                    <p>Générer des statistiques</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon primary">📚</div>
                    <div class="stat-info">
                        <h3>1,247</h3>
                        <p>Contenus Totaux</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon success">✅</div>
                    <div class="stat-info">
                        <h3>984</h3>
                        <p>Contenus Approuvés</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon warning">⏳</div>
                    <div class="stat-info">
                        <h3>42</h3>
                        <p>En Attente</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon danger">👥</div>
                    <div class="stat-info">
                        <h3>567</h3>
                        <p>Utilisateurs Actifs</p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <!-- Graphique principal - Activité des contenus -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Activité des Contenus (30 derniers jours)</h3>
                        <div class="chart-filters">
                            <button class="filter-btn active" data-period="30j">30J</button>
                            <button class="filter-btn" data-period="7j">7J</button>
                            <button class="filter-btn" data-period="12m">12M</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="contentActivityChart"></canvas>
                    </div>
                </div>

                <!-- Graphique secondaire - Répartition -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Répartition par Type</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="contentTypeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Deuxième ligne de graphiques -->
            <div class="charts-section">
                <!-- Graphique régions -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Contenus par Région</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="regionChart"></canvas>
                    </div>
                </div>

                <!-- Graphique langues -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3>Répartition par Langue</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="languageChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Content Table -->
            <div class="table-section">
                <div class="table-header">
                    <h3>Contenus Récents</h3>
                    <button class="btn btn-primary">Voir Tout</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Région</th>
                            <th>Langue</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>La légende de Têhou</td>
                            <td>Histoire</td>
                            <td>Zou</td>
                            <td>Fon</td>
                            <td><span class="status approved">Approuvé</span></td>
                            <td>15 Nov 2023</td>
                            <td class="action-buttons">
                                <button class="btn btn-primary btn-sm">Voir</button>
                                <button class="btn btn-danger btn-sm">Suppr</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Recette Akassa</td>
                            <td>Recette</td>
                            <td>Mono</td>
                            <td>Goun</td>
                            <td><span class="status approved">Approuvé</span></td>
                            <td>14 Nov 2023</td>
                            <td class="action-buttons">
                                <button class="btn btn-primary btn-sm">Voir</button>
                                <button class="btn btn-danger btn-sm">Suppr</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Danses Betamaribè</td>
                            <td>Article</td>
                            <td>Atacora</td>
                            <td>Dendi</td>
                            <td><span class="status pending">En attente</span></td>
                            <td>13 Nov 2023</td>
                            <td class="action-buttons">
                                <button class="btn btn-primary btn-sm">Voir</button>
                                <button class="btn btn-secondary btn-sm">Modérer</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Proverbes Yoruba</td>
                            <td>Proverbe</td>
                            <td>Plateau</td>
                            <td>Yoruba</td>
                            <td><span class="status rejected">Rejeté</span></td>
                            <td>12 Nov 2023</td>
                            <td class="action-buttons">
                                <button class="btn btn-primary btn-sm">Voir</button>
                                <button class="btn btn-danger btn-sm">Suppr</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Recent Activity -->
            <div class="activity-section">
                <h3 style="margin-bottom: 20px;">Activité Récente</h3>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--success-color);">✅</div>
                        <div class="activity-content">
                            <p><strong>Jean Dupont</strong> a soumis un nouveau contenu</p>
                            <span class="activity-time">Il y a 5 minutes</span>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--primary-color);">👤</div>
                        <div class="activity-content">
                            <p><strong>Marie Koné</strong> s'est inscrite sur la plateforme</p>
                            <span class="activity-time">Il y a 1 heure</span>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--warning-color);">🔤</div>
                        <div class="activity-content">
                            <p><strong>Paul Santos</strong> a ajouté une traduction en Fon</p>
                            <span class="activity-time">Il y a 2 heures</span>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--accent-color);">📝</div>
                        <div class="activity-content">
                            <p><strong>Admin</strong> a approuvé 3 contenus en attente</p>
                            <span class="activity-time">Il y a 3 heures</span>
                        </div>
                    </li>
                </ul>
            </div>

@endsection
</x-app-layout>
