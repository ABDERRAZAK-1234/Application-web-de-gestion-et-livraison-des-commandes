<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de livraison - Livraison Express</title>
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
                            <a class="nav-link" href="commands-list.php">
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
                    <div>
                        <a href="command-detail.php?id=" id="backLink" class="btn btn-outline-secondary btn-sm mb-2">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                        <h1 class="h3 mb-0">Suivi de livraison - Commande #<span id="commandId"></span></h1>
                    </div>
                    <div id="commandStatusBadge"></div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Timeline de suivi -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Historique</h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline" id="trackingTimeline">
                                    <!-- Timeline items will be added here -->
                                </div>
                            </div>
                        </div>

                        <!-- Informations de livraison -->
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informations</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small d-block mb-2">
                                            <i class="bi bi-geo-alt-fill text-primary me-2"></i>Adresse de départ
                                        </label>
                                        <p class="mb-0" id="pickupAddress"></p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="text-muted small d-block mb-2">
                                            <i class="bi bi-geo-alt text-success me-2"></i>Adresse de livraison
                                        </label>
                                        <p class="mb-0" id="deliveryAddress"></p>
                                    </div>
                                </div>
                                <hr>
                                <div id="delivererInfo"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Actions -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-lightning-charge me-2"></i>Actions</h5>
                            </div>
                            <div class="card-body" id="actionsSection">
                                <!-- Actions will be added here -->
                            </div>
                        </div>

                        <!-- Carte de localisation (simulation) -->
                        <div class="card">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-map me-2"></i>Localisation</h5>
                            </div>
                            <div class="card-body">
                                <div style="height: 300px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <div class="text-center text-muted">
                                        <i class="bi bi-geo-alt fs-1 mb-2"></i>
                                        <p class="mb-0">Carte de localisation</p>
                                        <small>(Simulation)</small>
                                    </div>
                                </div>
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
        let currentCommand = null;

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const commandId = parseInt(urlParams.get('id'));
            if (commandId) {
                document.getElementById('backLink').href = `command-detail.php?id=${commandId}`;
                loadCommandTracking(commandId);
            } else {
                showAlert('Commande introuvable', 'danger');
                setTimeout(() => window.location.href = 'commands-list.php', 1000);
            }
            updateNotificationCount();
        });

        function loadCommandTracking(id) {
            const commands = getCommands();
            const command = commands.find(c => c.id === id);
            
            if (!command) {
                showAlert('Commande introuvable', 'danger');
                setTimeout(() => window.location.href = 'commands-list.php', 1000);
                return;
            }

            currentCommand = command;
            displayTracking(command);
        }

        function displayTracking(cmd) {
            document.getElementById('commandId').textContent = cmd.id;
            document.getElementById('commandStatusBadge').innerHTML = getStatusBadge(cmd.status);
            document.getElementById('pickupAddress').textContent = cmd.pickupAddress;
            document.getElementById('deliveryAddress').textContent = cmd.deliveryAddress;

            // Timeline
            const timeline = document.getElementById('trackingTimeline');
            const events = [];

            events.push({
                date: cmd.createdAt,
                title: 'Commande créée',
                description: 'Votre commande a été créée et est en attente d\'offres',
                completed: true
            });

            if (cmd.acceptedAt) {
                events.push({
                    date: cmd.acceptedAt,
                    title: 'Offre acceptée',
                    description: 'Vous avez accepté une offre de livraison',
                    completed: true
                });
            }

            if (cmd.shippedAt) {
                events.push({
                    date: cmd.shippedAt,
                    title: 'Commande expédiée',
                    description: 'Le livreur a pris en charge votre commande',
                    completed: true
                });
            }

            if (cmd.status === 'completed' && cmd.completedAt) {
                events.push({
                    date: cmd.completedAt,
                    title: 'Livraison terminée',
                    description: 'Votre commande a été livrée avec succès',
                    completed: true
                });
            } else {
                events.push({
                    date: new Date().toISOString(),
                    title: 'En cours de livraison',
                    description: 'Votre commande est en route vers l\'adresse de livraison',
                    completed: cmd.status === 'completed'
                });
            }

            timeline.innerHTML = events.map(event => `
                <div class="timeline-item ${event.completed ? 'completed' : ''}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0">${event.title}</h6>
                                <small class="text-muted">${formatDate(event.date)}</small>
                            </div>
                            <p class="mb-0 text-muted small">${event.description}</p>
                        </div>
                    </div>
                </div>
            `).join('');

            // Informations livreur
            if (cmd.acceptedOffer) {
                document.getElementById('delivererInfo').innerHTML = `
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="mb-3"><i class="bi bi-person-badge me-2"></i>Livreur</h6>
                            <p class="mb-2"><strong>${cmd.acceptedOffer.delivererName}</strong></p>
                            <p class="mb-2 small text-muted">${cmd.acceptedOffer.vehicleType}</p>
                            <p class="mb-0 small">
                                <i class="bi bi-currency-euro me-1"></i>Prix : <strong>${cmd.acceptedOffer.price} €</strong><br>
                                <i class="bi bi-clock me-1"></i>Durée estimée : <strong>${cmd.acceptedOffer.estimatedTime}</strong>
                            </p>
                        </div>
                    </div>
                `;
            }

            // Actions
            const actionsContainer = document.getElementById('actionsSection');
            if (cmd.status === 'shipped' || cmd.status === 'processing') {
                actionsContainer.innerHTML = `
                    <p class="text-muted small mb-3">Votre commande est en cours de livraison</p>
                    ${cmd.status === 'shipped' ? `
                        <button onclick="validateDelivery(${cmd.id})" class="btn btn-success w-100">
                            <i class="bi bi-check-circle me-2"></i>Valider la livraison
                        </button>
                    ` : ''}
                `;
            } else if (cmd.status === 'completed') {
                actionsContainer.innerHTML = `
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>Livraison terminée !
                    </div>
                `;
            }
        }

        function validateDelivery(commandId) {
            if (confirm('Confirmez-vous que vous avez bien reçu votre commande ?')) {
                const commands = getCommands();
                const index = commands.findIndex(c => c.id === commandId);
                if (index !== -1) {
                    commands[index].status = 'completed';
                    commands[index].completedAt = new Date().toISOString();
                    saveCommands(commands);
                    showAlert('Livraison validée avec succès !', 'success');
                    setTimeout(() => {
                        loadCommandTracking(commandId);
                    }, 500);
                }
            }
        }
    </script>
</body>
</html>

