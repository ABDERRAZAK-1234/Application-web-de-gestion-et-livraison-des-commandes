<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraison Express - Livraison rapide et fiable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            transition: transform 0.3s;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .section-padding {
            padding: 80px 0;
        }
        .navbar-home {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-home fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="indexV.php">
                <i class="bi bi-truck text-primary me-2"></i>Livraison Express
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fonctionnalités</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">Comment ça marche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-primary ms-2" href="login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success ms-2 text-gray" href="register.php">
                            <i class="bi bi-person-plus me-1"></i>S'inscrire
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Livraison rapide et fiable</h1>
                    <p class="lead mb-4">
                        Connectez clients et livreurs pour une expérience de livraison optimale. 
                        Gérez vos commandes en temps réel avec notre plateforme intuitive.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="register.php" class="btn btn-light btn-lg">
                            <i class="bi bi-rocket-takeoff me-2"></i>Commencer maintenant
                        </a>
                        <a href="login.php" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <i class="bi bi-truck" style="font-size: 200px; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section-padding bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Fonctionnalités</h2>
                <p class="text-muted lead">Tout ce dont vous avez besoin pour gérer vos livraisons</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm border-0 h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="bi bi-person-circle text-primary" style="font-size: 48px;"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Pour les Clients</h4>
                            <ul class="list-unstyled text-start">
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Créer des commandes facilement</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Recevoir des offres de livreurs</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Suivre vos livraisons en temps réel</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Gérer toutes vos commandes</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm border-0 h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="bi bi-bicycle text-success" style="font-size: 48px;"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Pour les Livreurs</h4>
                            <ul class="list-unstyled text-start">
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Voir les commandes disponibles</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Envoyer des offres personnalisées</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Gérer vos livraisons</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Suivre vos performances</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card shadow-sm border-0 h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="bi bi-shield-check text-danger" style="font-size: 48px;"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Pour les Admins</h4>
                            <ul class="list-unstyled text-start">
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Superviser toutes les commandes</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Gérer les utilisateurs</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Voir les statistiques détaillées</li>
                                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Contrôler la plateforme</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works Section -->
    <section id="how-it-works" class="section-padding">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-3">Comment ça marche</h2>
                <p class="text-muted lead">Simple, rapide et efficace</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3 text-center">
                    <div class="mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <span class="display-6 fw-bold text-primary">1</span>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Créer une commande</h5>
                    <p class="text-muted">Le client crée une commande avec les détails de livraison</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="mb-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <span class="display-6 fw-bold text-success">2</span>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Recevoir des offres</h5>
                    <p class="text-muted">Les livreurs voient la commande et envoient leurs offres</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="mb-4">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <span class="display-6 fw-bold text-warning">3</span>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Accepter une offre</h5>
                    <p class="text-muted">Le client choisit et accepte l'offre qui lui convient</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="mb-4">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <span class="display-6 fw-bold text-info">4</span>
                        </div>
                    </div>
                    <h5 class="fw-bold mb-3">Livrer</h5>
                    <p class="text-muted">Le livreur prend en charge et livre la commande</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5 fw-bold mb-4">À propos de Livraison Express</h2>
                    <p class="lead text-muted mb-4">
                        Livraison Express est une plateforme moderne qui connecte clients et livreurs 
                        pour une expérience de livraison optimale. Notre système permet une gestion 
                        transparente et efficace des commandes.
                    </p>
                    <div class="row g-4 mb-4">
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="display-6 fw-bold text-primary">100%</h3>
                                <p class="text-muted">Responsive</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <h3 class="display-6 fw-bold text-success">24/7</h3>
                                <p class="text-muted">Disponible</p>
                            </div>
                        </div>
                    </div>
                    <a href="register.php" class="btn btn-primary btn-lg">
                        <i class="bi bi-rocket-takeoff me-2"></i>Rejoindre maintenant
                    </a>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <h4 class="fw-bold mb-4">Avantages</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i>
                                    <strong>Interface intuitive</strong> - Facile à utiliser pour tous
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i>
                                    <strong>Suivi en temps réel</strong> - Suivez vos commandes à chaque étape
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i>
                                    <strong>Sécurisé</strong> - Vos données sont protégées
                                </li>
                                <li class="mb-3">
                                    <i class="bi bi-check-circle-fill text-success me-2 fs-5"></i>
                                    <strong>Rapide</strong> - Traitement instantané des commandes
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-padding" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4">Prêt à commencer ?</h2>
            <p class="lead mb-4">Rejoignez Livraison Express dès aujourd'hui</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="register.php" class="btn btn-light btn-lg">
                    <i class="bi bi-person-plus me-2"></i>Créer un compte
                </a>
                <a href="login.php" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-truck me-2"></i>Livraison Express
                    </h5>
                    <p class="text-muted">
                        La plateforme de livraison moderne qui connecte clients et livreurs.
                    </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-white-50 text-decoration-none">Accueil</a></li>
                        <li class="mb-2"><a href="login.php" class="text-white-50 text-decoration-none">Connexion</a></li>
                        <li class="mb-2"><a href="register.php" class="text-white-50 text-decoration-none">Inscription</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold mb-3">Contact</h5>
                    <p class="text-muted mb-2">
                        <i class="bi bi-envelope me-2"></i>contact@livraison-express.com
                    </p>
                    <p class="text-muted">
                        <i class="bi bi-telephone me-2"></i>+33 1 23 45 67 89
                    </p>
                </div>
            </div>
            <hr class="my-4 bg-white-50">
            <div class="text-center text-muted">
                <p class="mb-0">&copy; 2024 Livraison Express. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-home');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 1)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });
    </script>
</body>
    </html>
