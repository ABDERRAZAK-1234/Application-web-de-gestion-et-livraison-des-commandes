// Gestion de l'authentification et des rôles

class AuthManager {
    constructor() {
        this.currentUser = this.getCurrentUser();
        this.init();
    }

    init() {
        // Vérifier si on est sur une page protégée
        if (this.isProtectedPage()) {
            if (!this.currentUser) {
                this.redirectToLogin();
                return;
            }
            this.setupNavigation();
        }
    }

    // Récupérer l'utilisateur actuel depuis localStorage
    getCurrentUser() {
        const userStr = localStorage.getItem('currentUser');
        return userStr ? JSON.parse(userStr) : null;
    }

    // Sauvegarder l'utilisateur dans localStorage
    saveUser(user) {
        localStorage.setItem('currentUser', JSON.stringify(user));
        this.currentUser = user;
    }

    // Vérifier si la page est protégée
    isProtectedPage() {
        const protectedPages = [
            'dashboard-client.php',
            'dashboard-livreur.php',
            'dashboard-admin.php',
            'create-command.php',
            'commands-list.php',
            'command-detail.php',
            'send-offer.php',
            'track-command.php',
            'manage-users.php',
            'statistics.php'
        ];
        const currentPage = window.location.pathname.split('/').pop();
        return protectedPages.includes(currentPage);
    }

    // Rediriger vers la page de connexion
    redirectToLogin() {
        window.location.href = 'login.php';
    }

    // Rediriger selon le rôle
    redirectByRole(role) {
        switch(role) {
            case 'client':
                window.location.href = 'dashboard-client.php';
                break;
            case 'livreur':
                window.location.href = 'dashboard-livreur.php';
                break;
            case 'admin':
                window.location.href = 'dashboard-admin.php';
                break;
            default:
                window.location.href = 'login.php';
        }
    }

    // Déconnexion
    logout() {
        localStorage.removeItem('currentUser');
        localStorage.removeItem('commands');
        localStorage.removeItem('offers');
        localStorage.removeItem('notifications');
        window.location.href = 'index.php';
    }

    // Vérifier si l'utilisateur a le bon rôle
    hasRole(requiredRole) {
        return this.currentUser && this.currentUser.role === requiredRole;
    }

    // Configurer la navigation selon le rôle
    setupNavigation() {
        const role = this.currentUser?.role;
        const navLinks = document.querySelectorAll('[data-role]');
        
        navLinks.forEach(link => {
            const linkRole = link.getAttribute('data-role');
            if (linkRole && linkRole !== role) {
                link.style.display = 'none';
            }
        });

        // Afficher le nom de l'utilisateur
        const userNameElements = document.querySelectorAll('.user-name');
        userNameElements.forEach(el => {
            if (this.currentUser) {
                el.textContent = this.currentUser.name;
            }
        });
    }
}

// Initialiser le gestionnaire d'authentification
const authManager = new AuthManager();

// Gestion du formulaire de connexion
if (document.getElementById('loginForm')) {
    document.getElementById('loginForm').addEventListener('submit', (e) => {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Simulation de connexion
        // En production, cela serait une requête API
        const users = [
            { email: 'client@demo.com', password: 'client', role: 'client', name: 'Jean Dupont', id: 1 },
            { email: 'livreur@demo.com', password: 'livreur', role: 'livreur', name: 'Marie Martin', id: 2 },
            { email: 'admin@demo.com', password: 'admin', role: 'admin', name: 'Admin System', id: 3 }
        ];

        const user = users.find(u => u.email === email && u.password === password);

        if (user) {
            authManager.saveUser(user);
            showAlert('Connexion réussie !', 'success');
            setTimeout(() => {
                authManager.redirectByRole(user.role);
            }, 500);
        } else {
            showAlert('Email ou mot de passe incorrect', 'danger');
        }
    });
}

// Gestion du formulaire d'inscription
if (document.getElementById('registerForm')) {
    document.getElementById('registerForm').addEventListener('submit', (e) => {
        e.preventDefault();
        
        const fullName = document.getElementById('fullName').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const role = document.getElementById('role').value;

        // Validation
        if (password !== confirmPassword) {
            showAlert('Les mots de passe ne correspondent pas', 'danger');
            return;
        }

        if (password.length < 6) {
            showAlert('Le mot de passe doit contenir au moins 6 caractères', 'danger');
            return;
        }

        // Simulation d'inscription
        const newUser = {
            id: Date.now(),
            name: fullName,
            email: email,
            phone: phone,
            role: role,
            password: password
        };

        authManager.saveUser(newUser);
        showAlert('Inscription réussie !', 'success');
        setTimeout(() => {
            authManager.redirectByRole(role);
        }, 500);
    });
}

// Fonction utilitaire pour afficher des alertes
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
    alertDiv.style.zIndex = '9999';
    alertDiv.style.minWidth = '300px';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 3000);
}

// Toggle sidebar mobile
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    if (sidebar && overlay) {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
    }
}

// Fermer sidebar au clic sur overlay
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.querySelector('.sidebar-overlay');
    if (overlay) {
        overlay.addEventListener('click', () => {
            toggleSidebar();
        });
    }
});

