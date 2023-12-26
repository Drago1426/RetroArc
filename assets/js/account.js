document.addEventListener('DOMContentLoaded', () => {
    // Elements for toggling between login and create account forms
    const loginForm = document.querySelector('.login-content-wrap');
    const createAccountForm = document.querySelector('.create-account-content-wrap');
    const showLoginBtn = document.getElementById('showLogin');
    const showCreateAccountBtn = document.getElementById('showCreateAccount');

    // Check if the elements exist before adding event listeners
    if (loginForm) {
        loginForm.style.display = 'none'; // Initially hide the login form
    }

    if (showLoginBtn) {
        showLoginBtn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default action of the button (if it's a submit button)
            if (loginForm) loginForm.style.display = 'block';
            if (createAccountForm) createAccountForm.style.display = 'none';
        });
    }

    if (showCreateAccountBtn) {
        showCreateAccountBtn.addEventListener('click', () => {
            if (loginForm) loginForm.style.display = 'none';
            if (createAccountForm) createAccountForm.style.display = 'block';
        });
    }

    // Assuming your form has an ID or a unique class you can use to select it
    const createAccountFormElement = document.querySelector('#createAccountForm'); // Replace with your form's selector
    if (createAccountFormElement) {
        createAccountFormElement.addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
    
            if (password !== confirmPassword) {
                event.preventDefault(); // Prevent form submission
                alert('The passwords do not match.');
            }
        });
    }
});
