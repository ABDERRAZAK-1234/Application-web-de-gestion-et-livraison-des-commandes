<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une commande - Livraison Express</title>
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
                            <a class="nav-link active" href="create-command.php">
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
                    <h1 class="h3">Créer une nouvelle commande</h1>
                    <a href="commands-list.php" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <form id="createCommandForm">
                                    <div class="mb-3">
                                        <label for="pickupAddress" class="form-label">
                                            <i class="bi bi-geo-alt-fill text-primary me-2"></i>Adresse de départ
                                        </label>
                                        <input type="text" class="form-control" id="pickupAddress" 
                                               placeholder="Ex: 123 Rue de la Paix, 75001 Paris" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deliveryAddress" class="form-label">
                                            <i class="bi bi-geo-alt text-success me-2"></i>Adresse de livraison
                                        </label>
                                        <input type="text" class="form-control" id="deliveryAddress" 
                                               placeholder="Ex: 456 Avenue des Champs, 75008 Paris" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i class="bi bi-card-text me-2"></i>Description de la commande
                                        </label>
                                        <textarea class="form-control" id="description" rows="4" 
                                                  placeholder="Décrivez le contenu de la commande..." required></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="weight" class="form-label">
                                                <i class="bi bi-weight me-2"></i>Poids (kg)
                                            </label>
                                            <input type="number" class="form-control" id="weight" 
                                                   min="0.1" step="0.1" placeholder="Ex: 2.5" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="dimensions" class="form-label">
                                                <i class="bi bi-arrows-angle-expand me-2"></i>Dimensions (L x l x H en cm)
                                            </label>
                                            <input type="text" class="form-control" id="dimensions" 
                                                   placeholder="Ex: 30x20x15">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="bi bi-tags me-2"></i>Options
                                        </label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="fragile">
                                                    <label class="form-check-label" for="fragile">
                                                        <i class="bi bi-exclamation-triangle text-warning me-1"></i>Fragile
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="express">
                                                    <label class="form-check-label" for="express">
                                                        <i class="bi bi-lightning-charge text-danger me-1"></i>Livraison express
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="signature">
                                                    <label class="form-check-label" for="signature">
                                                        <i class="bi bi-pen me-1"></i>Signature requise
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" id="insurance">
                                                    <label class="form-check-label" for="insurance">
                                                        <i class="bi bi-shield-check me-1"></i>Assurance
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="notes" class="form-label">
                                            <i class="bi bi-sticky me-2"></i>Notes supplémentaires
                                        </label>
                                        <textarea class="form-control" id="notes" rows="3" 
                                                  placeholder="Instructions spéciales pour le livreur..."></textarea>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="commands-list.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-x me-2"></i>Annuler
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-lg me-2"></i>Créer la commande
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Informations</h6>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted">
                                    <i class="bi bi-lightbulb me-2"></i>
                                    Remplissez tous les champs requis pour créer votre commande. 
                                    Les livreurs pourront ensuite vous faire des offres.
                                </p>
                                <hr>
                                <h6 class="small fw-bold">Conseils :</h6>
                                <ul class="small text-muted">
                                    <li>Indiquez des adresses précises</li>
                                    <li>Décrivez bien le contenu</li>
                                    <li>Cochez les options nécessaires</li>
                                    <li>Ajoutez des notes si besoin</li>
                                </ul>
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
        document.getElementById('createCommandForm').addEventListener('submit', (e) => {
            e.preventDefault();
            
            const user = authManager.getCurrentUser();
            if (!user || user.role !== 'client') {
                showAlert('Accès non autorisé', 'danger');
                return;
            }

            const command = {
                id: Date.now(),
                clientId: user.id,
                clientName: user.name,
                pickupAddress: document.getElementById('pickupAddress').value,
                deliveryAddress: document.getElementById('deliveryAddress').value,
                description: document.getElementById('description').value,
                weight: parseFloat(document.getElementById('weight').value),
                dimensions: document.getElementById('dimensions').value,
                options: {
                    fragile: document.getElementById('fragile').checked,
                    express: document.getElementById('express').checked,
                    signature: document.getElementById('signature').checked,
                    insurance: document.getElementById('insurance').checked
                },
                notes: document.getElementById('notes').value,
                status: 'pending',
                createdAt: new Date().toISOString(),
                offers: []
            };

            // Sauvegarder la commande
            const commands = getCommands();
            commands.push(command);
            saveCommands(commands);

            showAlert('Commande créée avec succès !', 'success');
            
            setTimeout(() => {
                window.location.href = 'commands-list.php';
            }, 1000);
        });
    </script>
</body>
</html>

