// public/app.js

/**
 * Load page content via AJAX or handle navigation
 */
function loadPage(page, element) {
    // Update active state in sidebar
    document.querySelectorAll('.sidebar ul li').forEach(li => {
        li.classList.remove('active');
    });
    
    // Activate the clicked item if element provided
    if (element) {
        element.classList.add('active');
    }

    // Handle different page routes
    const routes = {
        'home': '/dashboard',
        'dashboard': '/dashboard',
        'report': '/report',
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
    
    // Find the logout form
    const form = document.getElementById('logout-form');
    
    if (form) {
        console.log('Submitting logout form...');
        form.submit();
        return false;
    } else {
        console.error('Logout form not found! Redirecting to login...');
        window.location.href = '/login';
        return false;
    }
}

/**
 * View item details
 */
function viewItem(id) {
    console.log('Viewing item:', id);
    // window.location.href = '/items/' + id;
}

/**
 * Preview image before upload
 */
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            if (preview) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('App.js loaded successfully');
    
    // Debug: Check if logout form exists
    const logoutForm = document.getElementById('logout-form');
    if (logoutForm) {
        console.log('Logout form found:', logoutForm.action);
    } else {
        console.error('Logout form NOT found!');
    }
});