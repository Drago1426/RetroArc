document.addEventListener('DOMContentLoaded', () => {
    // Elements for toggling between login and create account forms
    const loginForm = document.querySelector('.login-content-wrap');
    const createAccountForm = document.querySelector('.create-account-content-wrap');
    const showLoginBtn = document.getElementById('showLogin');
    const showCreateAccountBtn = document.getElementById('showCreateAccount');

    // Initially hide the login form
    if (loginForm) loginForm.style.display = 'none';

    // Event listener for showing the login form
    if (showLoginBtn) {
        showLoginBtn.addEventListener('click', () => {
            event.preventDefault();
            if (loginForm) loginForm.style.display = 'block';
            if (createAccountForm) createAccountForm.style.display = 'none';
        });
    }

    // Event listener for showing the create account form
    if (showCreateAccountBtn) {
        showCreateAccountBtn.addEventListener('click', () => {
            if (loginForm) loginForm.style.display = 'none';
            if (createAccountForm) createAccountForm.style.display = 'block';
        });
    }

    // Additional elements or logic can be added here as needed
    createAccountForm.addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Prevent form submission
            alert('The passwords do not match.');
        }
    })
    
});
