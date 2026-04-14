// public/app.js

/**
 * Load page content via AJAX or handle navigation
 */
function loadPage(page) {
    // Update active state in sidebar
    document.querySelectorAll('.sidebar ul li').forEach(li => {
        li.classList.remove('active');
    });
    
    // Find and activate the clicked item
    const clickedItem = event?.currentTarget;
    if (clickedItem) {
        clickedItem.classList.add('active');
    }

    // Handle different page routes
    const routes = {
        'home': '/dashboard',
        'dashboard': '/dashboard',
        'admin-dashboard': '/admin',
        'report': '/report',
        'found': '/report',
        'browse': '/browse',
        'myitems': '/myitems',
        'profile': '/profile',
        'users': '/admin/users',
        'items': '/admin/items',
        'claims': '/admin/claims',
        'reports': '/admin/reports',
        'settings': '/admin/settings'
    };

    if (routes[page]) {
        window.location.href = routes[page];
    } else {
        console.log('Unknown page:', page);
    }
}

/**
 * Logout function - submits POST form to Laravel
 */
function logout() {
    if (!confirm('Are you sure you want to logout?')) {
        return false;
    }
    
    // Get the logout form
    const form = document.getElementById('logout-form');
    
    if (!form) {
        console.error('Logout form not found!');
        // Fallback: redirect to login
        window.location.href = '/login';
        return false;
    }
    
    // Submit the form
    form.submit();
    return false;
}

/**
 * View item details
 */
function viewItem(id) {
    console.log('Viewing item:', id);
    // window.location.href = '/items/' + id;
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('App.js loaded successfully');
});

