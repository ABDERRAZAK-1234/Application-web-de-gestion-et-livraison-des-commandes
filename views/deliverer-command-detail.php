<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail commande - Livreur</title>
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
                    <div>
                        <a href="available-commands.php" class="btn btn-outline-secondary btn-sm mb-2">
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
                            </div>
                        </div>

                        <!-- Autres offres (sans prix) -->
                        <div class="card mb-4" id="otherOffersSection" style="display: none;">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Autres offres</h5>
                            </div>
                            <div class="card-body" id="otherOffersList">
                                <!-- Other offers will be displayed here -->
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

                        <!-- Ma offre -->
                        <div class="card" id="myOfferSection" style="display: none;">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-envelope-paper me-2"></i>Mon offre</h5>
                            </div>
                            <div class="card-body" id="myOfferInfo">
                                <!-- My offer info will be displayed here -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Envoyer offre -->
    <div class="modal fade" id="sendOfferModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Envoyer une offre</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="offerForm">
                        <div class="mb-3">
                            <label for="offerPrice" class="form-label">Prix (€)</label>
                            <input type="number" class="form-control" id="offerPrice" 
                                   min="0" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="estimatedTime" class="form-label">Durée estimée</label>
                            <select class="form-select" id="estimatedTime" required>
                                <option value="">Sélectionner</option>
                                <option value="30 min">30 minutes</option>
                                <option value="1h">1 heure</option>
                                <option value="2h">2 heures</option>
                                <option value="3h">3 heures</option>
                                <option value="1 jour">1 jour</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleType" class="form-label">Type de véhicule</label>
                            <select class="form-select" id="vehicleType" required>
                                <option value="">Sélectionner</option>
                                <option value="Vélo">Vélo</option>
                                <option value="Scooter">Scooter</option>
                                <option value="Moto">Moto</option>
                                <option value="Voiture">Voiture</option>
                                <option value="Camionnette">Camionnette</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="offerMessage" class="form-label">Message (optionnel)</label>
                            <textarea class="form-control" id="offerMessage" rows="3" 
                                      placeholder="Ajoutez un message pour le client..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" onclick="submitOffer()">Envoyer l'offre</button>
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

        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const commandId = parseInt(urlParams.get('id'));
            if (commandId) {
                loadCommandDetail(commandId);
            } else {
                showAlert('Commande introuvable', 'danger');
                setTimeout(() => window.location.href = 'available-commands.php', 1000);
            }
            updateNotificationCount();
        });

        function loadCommandDetail(id) {
            const commands = getCommands();
            const command = commands.find(c => c.id === id);
            
            if (!command) {
                showAlert('Commande introuvable', 'danger');
                setTimeout(() => window.location.href = 'available-commands.php', 1000);
                return;
            }

            currentCommand = command;
            displayCommandDetail(command);
        }

        function displayCommandDetail(cmd) {
            const user = authManager.getCurrentUser();
            
            document.getElementById('commandId').textContent = cmd.id;
            document.getElementById('commandStatusBadge').innerHTML = getStatusBadge(cmd.status);
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

            // Vérifier si j'ai déjà envoyé une offre
            const myOffer = cmd.offers ? cmd.offers.find(o => o.delivererId === user.id) : null;
            
            // Autres offres (sans prix)
            const otherOffers = cmd.offers ? cmd.offers.filter(o => o.delivererId !== user.id) : [];
            if (otherOffers.length > 0) {
                document.getElementById('otherOffersSection').style.display = 'block';
                document.getElementById('otherOffersList').innerHTML = `
                    <p class="text-muted small mb-3">${otherOffers.length} autre(s) livreur(s) ont envoyé une offre</p>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Les prix des autres offres ne sont pas visibles pour maintenir la confidentialité.
                    </div>
                `;
            }

            // Ma offre
            if (myOffer) {
                document.getElementById('myOfferSection').style.display = 'block';
                document.getElementById('myOfferInfo').innerHTML = `
                    <div class="card bg-light">
                        <div class="card-body">
                            <p class="mb-2"><strong>Prix :</strong> ${myOffer.price} €</p>
                            <p class="mb-2"><strong>Durée :</strong> ${myOffer.estimatedTime}</p>
                            <p class="mb-2"><strong>Véhicule :</strong> ${myOffer.vehicleType}</p>
                            ${myOffer.accepted ? '<span class="badge bg-success">Offre acceptée</span>' : '<span class="badge bg-warning">En attente</span>'}
                        </div>
                    </div>
                `;
            }

            // Actions
            const actionsContainer = document.getElementById('actionsSection');
            if (cmd.status === 'pending') {
                if (myOffer) {
                    actionsContainer.innerHTML = `
                        <p class="text-muted small mb-3">Vous avez déjà envoyé une offre pour cette commande.</p>
                    `;
                } else {
                    actionsContainer.innerHTML = `
                        <button onclick="openSendOfferModal()" class="btn btn-success w-100">
                            <i class="bi bi-envelope-paper me-2"></i>Envoyer une offre
                        </button>
                    `;
                }
            } else if (cmd.status === 'processing' || cmd.status === 'shipped') {
                if (cmd.acceptedOffer && cmd.acceptedOffer.delivererId === user.id) {
                    actionsContainer.innerHTML = `
                        <a href="track-command.php?id=${cmd.id}" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-geo-alt me-2"></i>Suivre la livraison
                        </a>
                        ${cmd.status === 'processing' ? `
                            <button onclick="markAsShipped(${cmd.id})" class="btn btn-success w-100">
                                <i class="bi bi-truck me-2"></i>Marquer comme expédiée
                            </button>
                        ` : ''}
                    `;
                }
            }
        }

        function openSendOfferModal() {
            const modal = new bootstrap.Modal(document.getElementById('sendOfferModal'));
            document.getElementById('offerForm').reset();
            modal.show();
        }

        function submitOffer() {
            const user = authManager.getCurrentUser();
            if (!currentCommand) return;

            const price = parseFloat(document.getElementById('offerPrice').value);
            const estimatedTime = document.getElementById('estimatedTime').value;
            const vehicleType = document.getElementById('vehicleType').value;
            const message = document.getElementById('offerMessage').value;

            if (!price || !estimatedTime || !vehicleType) {
                showAlert('Veuillez remplir tous les champs requis', 'danger');
                return;
            }

            const offer = {
                id: Date.now(),
                commandId: currentCommand.id,
                delivererId: user.id,
                delivererName: user.name,
                price: price,
                estimatedTime: estimatedTime,
                vehicleType: vehicleType,
                message: message,
                createdAt: new Date().toISOString(),
                accepted: false
            };

            // Ajouter l'offre à la commande
            const commands = getCommands();
            const commandIndex = commands.findIndex(c => c.id === currentCommand.id);
            if (commandIndex !== -1) {
                if (!commands[commandIndex].offers) {
                    commands[commandIndex].offers = [];
                }
                commands[commandIndex].offers.push(offer);
                saveCommands(commands);

                // Sauvegarder l'offre séparément aussi
                const offers = getOffers();
                offers.push(offer);
                saveOffers(offers);

                // Créer une notification pour le client
                addNotification({
                    id: Date.now(),
                    userId: currentCommand.clientId,
                    type: 'new_offer',
                    title: 'Nouvelle offre reçue',
                    message: `Vous avez reçu une nouvelle offre pour la commande #${currentCommand.id}`,
                    createdAt: new Date().toISOString(),
                    read: false
                });

                showAlert('Offre envoyée avec succès !', 'success');
                bootstrap.Modal.getInstance(document.getElementById('sendOfferModal')).hide();
                
                setTimeout(() => {
                    loadCommandDetail(currentCommand.id);
                }, 500);
            }
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
                    setTimeout(() => {
                        loadCommandDetail(id);
                    }, 500);
                }
            }
        }
    </script>
</body>
</html>

