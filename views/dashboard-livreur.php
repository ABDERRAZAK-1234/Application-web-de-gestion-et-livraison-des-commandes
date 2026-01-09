<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Livreur - Livraison Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard-livreur.php">
                <i class="bi bi-bicycle me-2"></i>Livraison Express
            </a>
            <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#" onclick="authManager.logout()">
                    <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="sidebar-overlay" onclick="toggleSidebar()"></div>
            <nav class="col-md-3 col-lg-2 sidebar p-0" data-role="livreur">
                <div class="p-3">
                    <h6 class="text-muted text-uppercase small mb-3">Menu Livreur</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="dashboard-livreur.php">
                                <i class="bi bi-speedometer2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="available-commands.php">
                                <i class="bi bi-list-check"></i>Commandes disponibles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="my-offers.php">
                                <i class="bi bi-envelope-paper"></i>Mes offres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="accepted-commands.php">
                                <i class="bi bi-check-circle"></i>Commandes acceptées
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showNotifications()">
                                <i class="bi bi-bell"></i>Notifications
                                <span class="badge bg-danger ms-2" id="notificationCount">0</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3">Dashboard Livreur</h1>
                    <span class="text-muted">Bonjour, <strong class="user-name"></strong></span>
                </div>

                <!-- Statistiques -->
                <div class="dashboard-stats">
                    <div class="stat-item">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <div class="stat-value text-primary" id="availableCount">0</div>
                        <div class="stat-label">Disponibles</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-arrow-repeat"></i>
                        </div>
                        <div class="stat-value text-info" id="processingCount">0</div>
                        <div class="stat-label">En cours</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-value text-success" id="deliveredCount">0</div>
                        <div class="stat-label">Livrées</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-envelope-paper"></i>
                        </div>
                        <div class="stat-value text-warning" id="offersCount">0</div>
                        <div class="stat-label">Mes offres</div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-list-check fs-1 text-primary mb-3"></i>
                                <h5 class="card-title">Commandes disponibles</h5>
                                <p class="card-text text-muted">Consultez les commandes ouvertes à la livraison</p>
                                <a href="available-commands.php" class="btn btn-primary">
                                    <i class="bi bi-search me-2"></i>Voir les commandes
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-check-circle fs-1 text-success mb-3"></i>
                                <h5 class="card-title">Commandes acceptées</h5>
                                <p class="card-text text-muted">Gérez vos commandes en cours de livraison</p>
                                <a href="accepted-commands.php" class="btn btn-success">
                                    <i class="bi bi-list me-2"></i>Voir mes commandes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commandes en cours -->
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Commandes en cours</h5>
                        <a href="accepted-commands.php" class="btn btn-sm btn-outline-success">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <div id="currentCommands">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>Aucune commande en cours</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Notifications -->
    <div class="modal fade" id="notificationsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="notificationsList">
                    <!-- Notifications will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/auth.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            loadLivreurDashboard();
        });

        function loadLivreurDashboard() {
            const user = authManager.getCurrentUser();
            const commands = getCommands();
            const offers = getOffers();
            
            // Commandes disponibles (en attente)
            const available = commands.filter(c => c.status === 'pending');
            
            // Commandes acceptées par ce livreur
            const acceptedCommands = commands.filter(c => 
                c.acceptedOffer && c.acceptedOffer.delivererId === user.id
            );
            
            // Commandes en cours
            const processing = acceptedCommands.filter(c => 
                c.status === 'processing' || c.status === 'shipped'
            );
            
            // Commandes livrées
            const delivered = acceptedCommands.filter(c => c.status === 'completed');
            
            // Mes offres
            const myOffers = offers.filter(o => o.delivererId === user.id);
            
            // Afficher les statistiques
            document.getElementById('availableCount').textContent = available.length;
            document.getElementById('processingCount').textContent = processing.length;
            document.getElementById('deliveredCount').textContent = delivered.length;
            document.getElementById('offersCount').textContent = myOffers.length;
            
            // Afficher les commandes en cours
            displayCurrentCommands(processing);
            updateNotificationCount();
        }

        function displayCurrentCommands(commands) {
            const container = document.getElementById('currentCommands');
            
            if (commands.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Aucune commande en cours</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = commands.map(cmd => `
                <div class="command-card">
                    <div class="command-header">
                        <div class="command-info">
                            <h6 class="mb-1">Commande #${cmd.id}</h6>
                            <small class="text-muted">${formatDate(cmd.createdAt)}</small>
                            <div class="mt-2">${getStatusBadge(cmd.status)}</div>
                        </div>
                        <div class="command-actions">
                            <a href="deliverer-command-detail.html?id=${cmd.id}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Voir
                            </a>
                            ${cmd.status === 'processing' ? `
                                <button onclick="markAsShipped(${cmd.id})" class="btn btn-sm btn-success">
                                    <i class="bi bi-truck me-1"></i>Marquer comme expédiée
                                </button>
                            ` : ''}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">De :</small>
                            <p class="mb-0">${cmd.pickupAddress}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Vers :</small>
                            <p class="mb-0">${cmd.deliveryAddress}</p>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function markAsShipped(id) {
            if (confirm('Marquer cette commande comme expédiée ?')) {
                const commands = getCommands();
                const index = commands.findIndex(c => c.id === id);
                if (index !== -1) {
                    commands[index].status = 'shipped';
                    commands[index].shippedAt = new Date().toISOString();
                    saveCommands(commands);
                    showAlert('Commande marquée comme expédiée', 'success');
                    loadLivreurDashboard();
                }
            }
        }
    </script>
</body>
</html>

