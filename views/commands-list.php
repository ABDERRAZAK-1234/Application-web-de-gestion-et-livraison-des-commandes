<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes commandes - Livraison Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard-client.php">
                <i class="bi bi-truck me-2"></i>Livraison Express
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
            <nav class="col-md-3 col-lg-2 sidebar p-0" data-role="client">
                <div class="p-3">
                    <h6 class="text-muted text-uppercase small mb-3">Menu Client</h6>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard-client.php">
                                <i class="bi bi-speedometer2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create-command.php">
                                <i class="bi bi-plus-circle"></i>Créer une commande
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="commands-list.php">
                                <i class="bi bi-list-ul"></i>Mes commandes
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
                    <h1 class="h3">Mes commandes</h1>
                    <div>
                        <a href="create-command.php" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Nouvelle commande
                        </a>
                    </div>
                </div>

                <!-- Filtres -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Statut</label>
                                <select class="form-select" id="statusFilter" onchange="filterCommands()">
                                    <option value="">Tous les statuts</option>
                                    <option value="pending">En attente</option>
                                    <option value="processing">En cours</option>
                                    <option value="shipped">Expédiée</option>
                                    <option value="completed">Terminée</option>
                                    <option value="cancelled">Annulée</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Recherche</label>
                                <input type="text" class="form-control" id="searchFilter" 
                                       placeholder="Rechercher..." onkeyup="filterCommands()">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tri</label>
                                <select class="form-select" id="sortFilter" onchange="filterCommands()">
                                    <option value="newest">Plus récentes</option>
                                    <option value="oldest">Plus anciennes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liste des commandes -->
                <div id="commandsList">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Chargement...</span>
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
        let allCommands = [];

        document.addEventListener('DOMContentLoaded', () => {
            loadCommands();
            updateNotificationCount();
        });

        function loadCommands() {
            const user = authManager.getCurrentUser();
            const commands = getCommands();
            allCommands = commands.filter(c => c.clientId === user.id);
            displayCommands(allCommands);
        }

        function displayCommands(commands) {
            const container = document.getElementById('commandsList');
            
            if (commands.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h5>Aucune commande trouvée</h5>
                        <p class="text-muted">Vous n'avez pas encore de commandes.</p>
                        <a href="create-command.php" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle me-2"></i>Créer une commande
                        </a>
                    </div>
                `;
                return;
            }

            container.innerHTML = commands.map(cmd => `
                <div class="command-card">
                    <div class="command-header">
                        <div class="command-info">
                            <h6 class="mb-1">Commande #${cmd.id}</h6>
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>${formatDate(cmd.createdAt)}
                            </small>
                            <div class="mt-2">${getStatusBadge(cmd.status)}</div>
                        </div>
                        <div class="command-actions">
                            <a href="command-detail.php?id=${cmd.id}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Voir
                            </a>
                            ${cmd.status === 'pending' ? `
                                <a href="create-command.php?edit=${cmd.id}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil me-1"></i>Modifier
                                </a>
                                <button onclick="cancelCommand(${cmd.id})" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-x-circle me-1"></i>Annuler
                                </button>
                            ` : ''}
                            ${cmd.status === 'cancelled' || cmd.status === 'completed' ? `
                                <button onclick="deleteCommand(${cmd.id})" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash me-1"></i>Supprimer
                                </button>
                            ` : ''}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-geo-alt-fill text-primary"></i> De :
                            </small>
                            <p class="mb-0">${cmd.pickupAddress}</p>
                        </div>
                        <div class="col-md-6 mb-2">
                            <small class="text-muted d-block mb-1">
                                <i class="bi bi-geo-alt text-success"></i> Vers :
                            </small>
                            <p class="mb-0">${cmd.deliveryAddress}</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">Description :</small>
                        <p class="mb-0 text-truncate-2">${cmd.description}</p>
                    </div>
                    ${cmd.offers && cmd.offers.length > 0 ? `
                        <div class="mt-2">
                            <span class="badge bg-info">
                                <i class="bi bi-envelope me-1"></i>${cmd.offers.length} offre(s) reçue(s)
                            </span>
                        </div>
                    ` : ''}
                </div>
            `).join('');
        }

        function filterCommands() {
            const statusFilter = document.getElementById('statusFilter').value;
            const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
            const sortFilter = document.getElementById('sortFilter').value;

            let filtered = allCommands;

            // Filtrer par statut
            if (statusFilter) {
                filtered = filtered.filter(c => c.status === statusFilter);
            }

            // Filtrer par recherche
            if (searchFilter) {
                filtered = filtered.filter(c => 
                    c.description.toLowerCase().includes(searchFilter) ||
                    c.pickupAddress.toLowerCase().includes(searchFilter) ||
                    c.deliveryAddress.toLowerCase().includes(searchFilter) ||
                    c.id.toString().includes(searchFilter)
                );
            }

            // Trier
            if (sortFilter === 'newest') {
                filtered.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
            } else {
                filtered.sort((a, b) => new Date(a.createdAt) - new Date(b.createdAt));
            }

            displayCommands(filtered);
        }

        function cancelCommand(id) {
            if (confirm('Êtes-vous sûr de vouloir annuler cette commande ?')) {
                const commands = getCommands();
                const index = commands.findIndex(c => c.id === id);
                if (index !== -1) {
                    commands[index].status = 'cancelled';
                    saveCommands(commands);
                    showAlert('Commande annulée', 'success');
                    loadCommands();
                }
            }
        }

        function deleteCommand(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')) {
                const commands = getCommands();
                const filtered = commands.filter(c => c.id !== id);
                saveCommands(filtered);
                showAlert('Commande supprimée', 'success');
                loadCommands();
            }
        }
    </script>
</body>
</html>

