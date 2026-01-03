// Fonctions utilitaires partagées

// Gestion des commandes
function getCommands() {
    const commandsStr = localStorage.getItem('commands');
    if (commandsStr) {
        return JSON.parse(commandsStr);
    }
    // Initialiser avec quelques commandes de démonstration
    const demoCommands = [
        {
            id: 1001,
            clientId: 1,
            clientName: 'Jean Dupont',
            pickupAddress: '123 Rue de la Paix, 75001 Paris',
            deliveryAddress: '456 Avenue des Champs, 75008 Paris',
            description: 'Livraison de documents importants',
            weight: 0.5,
            dimensions: '30x20x5',
            options: { fragile: true, express: true },
            notes: 'Livraison urgente',
            status: 'pending',
            createdAt: new Date(Date.now() - 2 * 24 * 60 * 60 * 1000).toISOString(),
            offers: []
        }
    ];
    saveCommands(demoCommands);
    return demoCommands;
}

function saveCommands(commands) {
    localStorage.setItem('commands', JSON.stringify(commands));
}

// Gestion des offres
function getOffers() {
    const offersStr = localStorage.getItem('offers');
    return offersStr ? JSON.parse(offersStr) : [];
}

function saveOffers(offers) {
    localStorage.setItem('offers', JSON.stringify(offers));
}

// Gestion des notifications
function getNotifications() {
    const user = authManager.getCurrentUser();
    if (!user) return [];
    
    const notificationsStr = localStorage.getItem('notifications');
    const allNotifications = notificationsStr ? JSON.parse(notificationsStr) : [];
    return allNotifications.filter(n => n.userId === user.id);
}

function saveNotifications(notifications) {
    localStorage.setItem('notifications', JSON.stringify(notifications));
}

function addNotification(notification) {
    const notificationsStr = localStorage.getItem('notifications');
    const notifications = notificationsStr ? JSON.parse(notificationsStr) : [];
    notifications.push(notification);
    saveNotifications(notifications);
}

function markNotificationAsRead(notificationId) {
    const notificationsStr = localStorage.getItem('notifications');
    const notifications = notificationsStr ? JSON.parse(notificationsStr) : [];
    const index = notifications.findIndex(n => n.id === notificationId);
    if (index !== -1) {
        notifications[index].read = true;
        saveNotifications(notifications);
    }
}

function updateNotificationCount() {
    const notifications = getNotifications();
    const unreadCount = notifications.filter(n => !n.read).length;
    const countElements = document.querySelectorAll('#notificationCount');
    countElements.forEach(el => {
        el.textContent = unreadCount;
        if (unreadCount > 0) {
            el.style.display = 'inline-block';
        } else {
            el.style.display = 'none';
        }
    });
}

function loadNotifications() {
    const notifications = getNotifications();
    const container = document.getElementById('notificationsList');
    
    if (notifications.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <i class="bi bi-bell-slash"></i>
                <p>Aucune notification</p>
            </div>
        `;
        return;
    }

    // Trier par date (plus récentes en premier)
    notifications.sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));

    container.innerHTML = notifications.map(notif => `
        <div class="notification-item ${notif.read ? 'read' : 'unread'}" onclick="markNotificationAsRead(${notif.id})">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <h6 class="mb-1">${notif.title}</h6>
                    <p class="mb-1 small">${notif.message}</p>
                    <small class="text-muted">${formatDate(notif.createdAt)}</small>
                </div>
                ${!notif.read ? '<span class="badge bg-primary">Nouveau</span>' : ''}
            </div>
        </div>
    `).join('');
}

function markNotificationAsRead(notificationId) {
    const notificationsStr = localStorage.getItem('notifications');
    const notifications = notificationsStr ? JSON.parse(notificationsStr) : [];
    const index = notifications.findIndex(n => n.id === notificationId);
    if (index !== -1) {
        notifications[index].read = true;
        saveNotifications(notifications);
        updateNotificationCount();
        loadNotifications();
    }
}

function showNotifications() {
    const modal = new bootstrap.Modal(document.getElementById('notificationsModal'));
    loadNotifications();
    modal.show();
}

// Formatage des dates
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now - date;
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(diff / 3600000);
    const days = Math.floor(diff / 86400000);

    if (minutes < 1) return 'À l\'instant';
    if (minutes < 60) return `Il y a ${minutes} minute${minutes > 1 ? 's' : ''}`;
    if (hours < 24) return `Il y a ${hours} heure${hours > 1 ? 's' : ''}`;
    if (days < 7) return `Il y a ${days} jour${days > 1 ? 's' : ''}`;
    
    return date.toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Badges de statut
function getStatusBadge(status) {
    const statusConfig = {
        'pending': {
            label: 'En attente',
            icon: 'bi-clock-history',
            class: 'status-pending'
        },
        'processing': {
            label: 'En cours',
            icon: 'bi-arrow-repeat',
            class: 'status-processing'
        },
        'shipped': {
            label: 'Expédiée',
            icon: 'bi-truck',
            class: 'status-shipped'
        },
        'completed': {
            label: 'Terminée',
            icon: 'bi-check-circle',
            class: 'status-completed'
        },
        'cancelled': {
            label: 'Annulée',
            icon: 'bi-x-circle',
            class: 'status-cancelled'
        }
    };

    const config = statusConfig[status] || statusConfig['pending'];
    return `<span class="status-badge ${config.class}">
        <i class="bi ${config.icon}"></i>
        ${config.label}
    </span>`;
}

// Fonction utilitaire pour afficher des alertes (si pas déjà définie)
if (typeof showAlert === 'undefined') {
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
}

