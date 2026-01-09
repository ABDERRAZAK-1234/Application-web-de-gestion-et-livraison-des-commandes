<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de la commande - Livraison Express</title>
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
                        <a href="commands-list.php" class="btn btn-outline-secondary btn-sm mb-2">
                            <i class="bi bi-arrow-left me-2"></i>Retour
                        </a>
                        <h1 class="h3 mb-0">Commande #<span id="commandId"></span></h1>
                    </div>
                    <div id="commandStatusBadge"></div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Informations de la commande -->
                        <div class="card mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informations</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="text-muted small">Date de création</label>
                                        <p class="mb-0" id="createdAt"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small">Statut</label>
                                        <p class="mb-0" id="status"></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="text-muted small d-block mb-2">
                                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>Adresse de départ
                                    </label>
                                    <p class="mb-0" id="pickupAddress"></p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small d-block mb-2">
                                        <i class="bi bi-geo-alt text-success me-2"></i>Adresse de livraison
                                    </label>
                                    <p class="mb-0" id="deliveryAddress"></p>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label class="text-muted small d-block mb-2">Description</label>
                                    <p class="mb-0" id="description"></p>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-muted small">Poids</label>
                                        <p class="mb-0" id="weight"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-muted small">Dimensions</label>
                                        <p class="mb-0" id="dimensions"></p>
                                    </div>
                                </div>
                                <div id="optionsSection" class="mt-3"></div>
                                <div id="notesSection" class="mt-3"></div>
                            </div>
                        </div>

                        <!-- Offres reçues -->
                        <div class="card mb-4" id="offersSection">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-envelope me-2"></i>Offres reçues</h5>
                                <span class="badge bg-info" id="offersCount">0</span>
                            </div>
                            <div class="card-body" id="offersList">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>
                                    <p>Aucune offre reçue pour le moment</p>
                                </div>
                            </div>
                        </div>

                        <!-- Suivi de livraison -->
                        <div class="card" id="trackingSection" style="display: none;">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Suivi de livraison</h5>
                            </div>
                            <div class="card-body">
                                <div class="timeline" id="trackingTimeline">
                                    <!-- Timeline items will be added here -->
                                </div>
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

                        <!-- Informations livreur -->
                        <div class="card" id="delivererSection" style="display: none;">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Livreur assigné</h5>
                            </div>
                            <div class="card-body" id="delivererInfo">
                                <!-- Deliverer info will be added here -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Accepter offre -->
    <div class="modal fade" id="acceptOfferModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Accepter l'offre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir accepter cette offre ?</p>
                    <div id="offerDetails"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" onclick="confirmAcceptOffer()">Accepter</button>
                </div>
            </div>
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
        let selectedOfferId = null;

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const commandId = parseInt(urlParams.get('id'));
            if (commandId) {
                loadCommandDetail(commandId);
            } else {
                showAlert('Commande introuvable', 'danger');
                setTimeout(() => window.location.href = 'commands-list.php', 1000);
            }
            updateNotificationCount();
        });

        function loadCommandDetail(id) {
            const commands = getCommands();
            const command = commands.find(c => c.id === id);
            
            if (!command) {
                showAlert('Commande introuvable', 'danger');
                setTimeout(() => window.location.href = 'commands-list.php', 1000);
                return;
            }

            currentCommand = command;
            displayCommandDetail(command);
        }

        function displayCommandDetail(cmd) {
            document.getElementById('commandId').textContent = cmd.id;
            document.getElementById('commandStatusBadge').innerHTML = getStatusBadge(cmd.status);
            document.getElementById('createdAt').textContent = formatDate(cmd.createdAt);
            document.getElementById('status').innerHTML = getStatusBadge(cmd.status);
            document.getElementById('pickupAddress').textContent = cmd.pickupAddress;
            document.getElementById('deliveryAddress').textContent = cmd.deliveryAddress;
            document.getElementById('description').textContent = cmd.description;
            document.getElementById('weight').textContent = cmd.weight ? `${cmd.weight} kg` : 'Non spécifié';
            document.getElementById('dimensions').textContent = cmd.dimensions || 'Non spécifié';

            // Options
            if (cmd.options) {
                const options = [];
                if (cmd.options.fragile) options.push('<span class="badge bg-warning"><i class="bi bi-exclamation-triangle me-1"></i>Fragile</span>');
                if (cmd.options.express) options.push('<span class="badge bg-danger"><i class="bi bi-lightning-charge me-1"></i>Express</span>');
                if (cmd.options.signature) options.push('<span class="badge bg-info"><i class="bi bi-pen me-1"></i>Signature</span>');
                if (cmd.options.insurance) options.push('<span class="badge bg-success"><i class="bi bi-shield-check me-1"></i>Assurance</span>');
                document.getElementById('optionsSection').innerHTML = options.length > 0 ? 
                    `<label class="text-muted small d-block mb-2">Options</label><div>${options.join(' ')}</div>` : '';
            }

            // Notes
            if (cmd.notes) {
                document.getElementById('notesSection').innerHTML = `
                    <label class="text-muted small d-block mb-2">Notes</label>
                    <p class="mb-0">${cmd.notes}</p>
                `;
            }

            // Offres
            displayOffers(cmd.offers || []);

            // Actions selon le statut
            displayActions(cmd);

            // Livreur assigné
            if (cmd.acceptedOffer && cmd.acceptedOffer.delivererName) {
                displayDeliverer(cmd.acceptedOffer);
            }
        }

        function displayOffers(offers) {
            const container = document.getElementById('offersList');
            const countBadge = document.getElementById('offersCount');
            
            countBadge.textContent = offers.length;

            if (offers.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <p>Aucune offre reçue pour le moment</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = offers.map(offer => `
                <div class="card mb-3 ${offer.accepted ? 'border-success' : ''}">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1">${offer.delivererName}</h6>
                                <small class="text-muted">${formatDate(offer.createdAt)}</small>
                            </div>
                            ${offer.accepted ? '<span class="badge bg-success">Acceptée</span>' : ''}
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <small class="text-muted">Prix</small>
                                <p class="mb-0 fw-bold text-primary">${offer.price} €</p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted">Durée estimée</small>
                                <p class="mb-0">${offer.estimatedTime}</p>
                            </div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Véhicule</small>
                            <p class="mb-0">${offer.vehicleType}</p>
                        </div>
                        ${offer.message ? `
                            <div class="mb-2">
                                <small class="text-muted">Message</small>
                                <p class="mb-0 small">${offer.message}</p>
                            </div>
                        ` : ''}
                        ${!offer.accepted && currentCommand.status === 'pending' ? `
                            <button onclick="acceptOffer(${offer.id})" class="btn btn-sm btn-success w-100">
                                <i class="bi bi-check-lg me-1"></i>Accepter cette offre
                            </button>
                        ` : ''}
                    </div>
                </div>
            `).join('');
        }

        function displayActions(cmd) {
            const container = document.getElementById('actionsSection');
            let actions = '';

            if (cmd.status === 'pending') {
                actions = `
                    <p class="text-muted small mb-3">En attente d'offres de livreurs</p>
                    <a href="create-command.html?edit=${cmd.id}" class="btn btn-outline-warning w-100 mb-2">
                        <i class="bi bi-pencil me-1"></i>Modifier
                    </a>
                    <button onclick="cancelCommand(${cmd.id})" class="btn btn-outline-danger w-100">
                        <i class="bi bi-x-circle me-1"></i>Annuler
                    </button>
                `;
            } else if (cmd.status === 'processing' || cmd.status === 'shipped') {
                actions = `
                    <a href="track-command.html?id=${cmd.id}" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-geo-alt me-1"></i>Suivre la livraison
                    </a>
                `;
            } else if (cmd.status === 'completed') {
                actions = `
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>Commande livrée avec succès !
                    </div>
                `;
            } else if (cmd.status === 'cancelled') {
                actions = `
                    <div class="alert alert-danger">
                        <i class="bi bi-x-circle me-2"></i>Commande annulée
                    </div>
                `;
            }

            container.innerHTML = actions;
        }

        function displayDeliverer(offer) {
            document.getElementById('delivererSection').style.display = 'block';
            document.getElementById('delivererInfo').innerHTML = `
                <p class="mb-2"><strong>${offer.delivererName}</strong></p>
                <p class="mb-2 small text-muted">${offer.vehicleType}</p>
                <p class="mb-0 small">
                    <i class="bi bi-currency-euro me-1"></i>Prix : <strong>${offer.price} €</strong><br>
                    <i class="bi bi-clock me-1"></i>Durée : <strong>${offer.estimatedTime}</strong>
                </p>
            `;
        }

        function acceptOffer(offerId) {
            selectedOfferId = offerId;
            const offer = currentCommand.offers.find(o => o.id === offerId);
            if (offer) {
                document.getElementById('offerDetails').innerHTML = `
                    <div class="card">
                        <div class="card-body">
                            <p><strong>Livreur :</strong> ${offer.delivererName}</p>
                            <p><strong>Prix :</strong> ${offer.price} €</p>
                            <p><strong>Durée estimée :</strong> ${offer.estimatedTime}</p>
                            <p><strong>Véhicule :</strong> ${offer.vehicleType}</p>
                        </div>
                    </div>
                `;
                const modal = new bootstrap.Modal(document.getElementById('acceptOfferModal'));
                modal.show();
            }
        }

        function confirmAcceptOffer() {
            if (!selectedOfferId || !currentCommand) return;

            const commands = getCommands();
            const commandIndex = commands.findIndex(c => c.id === currentCommand.id);
            if (commandIndex === -1) return;

            const offer = commands[commandIndex].offers.find(o => o.id === selectedOfferId);
            if (offer) {
                // Marquer l'offre comme acceptée
                commands[commandIndex].offers.forEach(o => {
                    o.accepted = o.id === selectedOfferId;
                });
                commands[commandIndex].acceptedOffer = offer;
                commands[commandIndex].status = 'processing';
                commands[commandIndex].acceptedAt = new Date().toISOString();

                saveCommands(commands);

                // Créer une notification pour le livreur
                addNotification({
                    id: Date.now(),
                    userId: offer.delivererId,
                    type: 'offer_accepted',
                    title: 'Offre acceptée',
                    message: `Votre offre pour la commande #${currentCommand.id} a été acceptée !`,
                    createdAt: new Date().toISOString(),
                    read: false
                });

                showAlert('Offre acceptée avec succès !', 'success');
                bootstrap.Modal.getInstance(document.getElementById('acceptOfferModal')).hide();
                
                setTimeout(() => {
                    loadCommandDetail(currentCommand.id);
                }, 500);
            }
        }

        function cancelCommand(id) {
            if (confirm('Êtes-vous sûr de vouloir annuler cette commande ?')) {
                const commands = getCommands();
                const index = commands.findIndex(c => c.id === id);
                if (index !== -1) {
                    commands[index].status = 'cancelled';
                    saveCommands(commands);
                    showAlert('Commande annulée', 'success');
                    setTimeout(() => {
                        loadCommandDetail(id);
                    }, 500);
                }
            }
        }
    </script>
</body>
</html>

