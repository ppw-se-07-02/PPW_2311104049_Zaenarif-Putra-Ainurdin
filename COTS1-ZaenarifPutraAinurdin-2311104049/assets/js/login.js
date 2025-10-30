// Login Page JavaScript
$(document).ready(function() {
    console.log('🔐 Login Page initialized');
    
    // Toggle password visibility
    $('#togglePassword').on('click', function() {
        const passwordInput = $('#password');
        const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
        passwordInput.attr('type', type);
        
        // Toggle eye icon
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
    
    // Login form submission
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        
        const email = $('#email').val();
        const password = $('#password').val();
        const rememberMe = $('#rememberMe').is(':checked');
        
        // Simple validation
        if (!email || !password) {
            showLoginMessage('warning', 'Harap isi semua field!');
            return;
        }
        
        // Simulate login process
        simulateLogin(email, password, rememberMe);
    });
});

// Simulate login process
function simulateLogin(email, password, rememberMe) {
    const loginBtn = $('#loginForm button[type="submit"]');
    const originalText = loginBtn.html();
    
    // Show loading state
    loginBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>PROSES LOGIN...');
    loginBtn.prop('disabled', true);
    
    // Simulate API call
    setTimeout(() => {
        // For demo purposes, always success
        // In real app, you would validate credentials with backend
        showLoginMessage('success', 'Login berhasil! Mengarahkan ke beranda...');
        
        // Redirect to home page after success
        setTimeout(() => {
            window.location.href = 'index.html';
        }, 2000);
        
    }, 1500);
}

// Show login message
function showLoginMessage(type, message) {
    // Remove existing messages
    $('.login-message').remove();
    
    const alertClass = type === 'success' ? 'alert-success' : 'alert-warning';
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    
    const messageHTML = `
        <div class="alert ${alertClass} alert-dismissible fade show login-message" role="alert">
            <i class="fas ${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('#loginForm').prepend(messageHTML);
}