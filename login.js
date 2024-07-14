document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('loginForm');
    form.addEventListener('submit', function(event) {
        let errors = [];

        const email = document.getElementsByName('email')[0].value;
        const password = document.getElementsByName('password')[0].value;

        const errorContainer = document.getElementById('error-container');
        errorContainer.innerHTML = '';

        if (email.trim() === '') {
            errors.push({ field: 'email', message: 'Email is required.' });
        }

        if (password.trim() === '') {
            errors.push({ field: 'password', message: 'Password is required.' });
        }

        if (errors.length > 0) {
            event.preventDefault();
            displayErrors(errors);
        }
    });

    function displayErrors(errors) {
        errors.forEach(error => {
            const inputField = document.getElementsByName(error.field)[0];
            const existingError = inputField.parentNode.querySelector('.error-message');
            
            if (existingError) {
                existingError.textContent = error.message;
            } else {
                const errorElement = document.createElement('p');
                errorElement.textContent = error.message;
                errorElement.className = 'error-message';
                errorElement.style.color = '#dc3545'; 
                inputField.parentNode.appendChild(errorElement);
            }
        });
    }
});
