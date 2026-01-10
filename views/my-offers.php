<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes offres - Livraison Express</title>
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
                            <a class="nav-link" href="dashboard-livreur.php">
                                <i class="bi bi-speedometer2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="available-commands.php">
                                <i class="bi bi-list-check"></i>Commandes disponibles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="my-offers.php">
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
                    <h1 class="h3">Mes offres</h1>
                </div>

                <!-- Liste des offres -->
                <div id="offersList">
                    <div class="text-center py-5">
                        <div class="spinner-border text-success" role="status">
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
        document.addEventListener('DOMContentLoaded', () => {
            loadMyOffers();
            updateNotificationCount();
        });

        function loadMyOffers() {
            const user = authManager.getCurrentUser();
            const offers = getOffers();
            const myOffers = offers.filter(o => o.delivererId === user.id);
            const commands = getCommands();

            displayOffers(myOffers, commands);
        }

        function displayOffers(offers, commands) {
            const container = document.getElementById('offersList');
            
            if (offers.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h5>Aucune offre envoyée</h5>
                        <p class="text-muted">Vous n'avez pas encore envoyé d'offres.</p>
                        <a href="available-commands.php" class="btn btn-success mt-3">
                            <i class="bi bi-search me-2"></i>Voir les commandes disponibles
                        </a>
                    </div>
                `;
                return;
            }

            // Trier par date (plus récentes en premier)
            offers.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));

            container.innerHTML = offers.map(offer => {
                const command = commands.find(c => c.id === offer.commandId);
                const isAccepted = command && command.acceptedOffer && command.acceptedOffer.id === offer.id;
                
                return `
                    <div class="command-card ${isAccepted ? 'border-success' : ''}">
                        <div class="command-header">
                            <div class="command-info">
                                <h6 class="mb-1">Commande #${offer.commandId}</h6>
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>Offre envoyée le ${formatDate(offer.createdAt)}
                                </small>
                                <div class="mt-2">
                                    ${isAccepted ? 
                                        '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Acceptée</span>' : 
                                        '<span class="badge bg-warning"><i class="bi bi-clock me-1"></i>En attente</span>'
                                    }
                                </div>
                            </div>
                            <div class="command-actions">
                                <a href="deliverer-command-detail.php?id=${offer.commandId}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>Voir
                                </a>
                            </div>
                        </div>
                        ${command ? `
                            <div class="row mt-3">
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bi bi-geo-alt-fill text-primary"></i> De :
                                    </small>
                                    <p class="mb-0">${command.pickupAddress}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <small class="text-muted d-block mb-1">
                                        <i class="bi bi-geo-alt text-success"></i> Vers :
                                    </small>
                                    <p class="mb-0">${command.deliveryAddress}</p>
                                </div>
                            </div>
                        ` : ''}
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <small class="text-muted">Prix proposé</small>
                                <p class="mb-0 fw-bold text-primary">${offer.price} €</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Durée estimée</small>
                                <p class="mb-0">${offer.estimatedTime}</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Véhicule</small>
                                <p class="mb-0">${offer.vehicleType}</p>
                            </div>
                        </div>
                        ${offer.message ? `
                            <div class="mt-2">
                                <small class="text-muted">Message :</small>
                                <p class="mb-0 small">${offer.message}</p>
                            </div>
                        ` : ''}
                    </div>
                `;
            }).join('');
        }
    </script>
</body>
</html>

