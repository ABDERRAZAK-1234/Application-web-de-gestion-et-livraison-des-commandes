<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Livraison Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard-admin.php">
                <i class="bi bi-shield-check me-2"></i>Livraison Express
            </a>
            <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php" onclick="authManager.logout()">
                    <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
            <nav class="col-md-3 col-lg-2 sidebar p-0" data-role="admin">
                <div class="p-3">
                    <h6 class="text-muted text-uppercase small mb-3">Menu Admin</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard-admin.php">
                                <i class="bi bi-speedometer2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage-users.php">
                                <i class="bi bi-people"></i>Gestion utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="statistics.php">
                                <i class="bi bi-graph-up"></i>Statistiques
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Dashboard Administrateur</h1>
                    <span class="text-muted">Bonjour, <strong class="user-name"></strong></span>
                </div>

                <!-- Statistiques globales -->
                <div class="dashboard-stats">
                    <div class="stat-item">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-cart-plus"></i>
                        </div>
                        <div class="stat-value text-primary" id="totalCommands">0</div>
                        <div class="stat-label">Commandes créées</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-value text-success" id="completedCommands">0</div>
                        <div class="stat-label">Commandes terminées</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="stat-value text-danger" id="cancelledCommands">0</div>
                        <div class="stat-label">Commandes annulées</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-envelope-paper"></i>
                        </div>
                        <div class="stat-value text-info" id="totalOffers">0</div>
                        <div class="stat-label">Offres envoyées</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-bicycle"></i>
                        </div>
                        <div class="stat-value text-warning" id="activeDeliverers">0</div>
                        <div class="stat-label">Livreurs actifs</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-secondary bg-opacity-10 text-secondary">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="stat-value text-secondary" id="totalUsers">0</div>
                        <div class="stat-label">Utilisateurs</div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-people fs-1 text-primary mb-3"></i>
                                <h5 class="card-title">Gestion utilisateurs</h5>
                                <p class="card-text text-muted">Gérer les utilisateurs et leurs rôles</p>
                                <a href="manage-users.php" class="btn btn-primary">
                                    <i class="bi bi-arrow-right me-2"></i>Gérer
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-graph-up fs-1 text-success mb-3"></i>
                                <h5 class="card-title">Statistiques</h5>
                                <p class="card-text text-muted">Voir les statistiques détaillées</p>
                                <a href="statistics.php" class="btn btn-success">
                                    <i class="bi bi-arrow-right me-2"></i>Voir
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-list-ul fs-1 text-info mb-3"></i>
                                <h5 class="card-title">Toutes les commandes</h5>
                                <p class="card-text text-muted">Voir toutes les commandes du système</p>
                                <button onclick="viewAllCommands()" class="btn btn-info text-white">
                                    <i class="bi bi-arrow-right me-2"></i>Voir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commandes récentes -->
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Commandes récentes</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="recentCommandsTable">
                                    <!-- Will be populated by JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/auth.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            loadAdminDashboard();
        });

        function loadAdminDashboard() {
            const commands = getCommands();
            const offers = getOffers();
            
            // Statistiques
            document.getElementById('totalCommands').textContent = commands.length;
            document.getElementById('completedCommands').textContent = 
                commands.filter(c => c.status === 'completed').length;
            document.getElementById('cancelledCommands').textContent = 
                commands.filter(c => c.status === 'cancelled').length;
            document.getElementById('totalOffers').textContent = offers.length;
            
            // Livreurs actifs (simulation - en production, cela viendrait d'une base de données)
            const activeDeliverers = new Set();
            commands.forEach(cmd => {
                if (cmd.acceptedOffer && cmd.acceptedOffer.delivererId) {
                    activeDeliverers.add(cmd.acceptedOffer.delivererId);
                }
            });
            document.getElementById('activeDeliverers').textContent = activeDeliverers.size;
            
            // Total utilisateurs (simulation)
            document.getElementById('totalUsers').textContent = '3'; // Comptes de démo
            
            // Commandes récentes
            displayRecentCommands(commands.slice(-10).reverse());
        }

        function displayRecentCommands(commands) {
            const tbody = document.getElementById('recentCommandsTable');
            
            if (commands.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Aucune commande
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = commands.map(cmd => `
                <tr>
                    <td>#${cmd.id}</td>
                    <td>${cmd.clientName || 'N/A'}</td>
                    <td>${getStatusBadge(cmd.status)}</td>
                    <td>${formatDate(cmd.createdAt)}</td>
                    <td>
                        <button onclick="viewCommand(${cmd.id})" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function viewCommand(id) {
            // En production, cela ouvrirait une page de détail admin
            alert(`Détail de la commande #${id} (Fonctionnalité à implémenter)`);
        }

        function viewAllCommands() {
            alert('Liste de toutes les commandes (Fonctionnalité à implémenter)');
        }
    </script>
</body>
</html>

