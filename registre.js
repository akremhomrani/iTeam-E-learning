document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('register');
    form.addEventListener('submit', function(event) {
        let errors = [];

        const nom = document.getElementsByName('nom')[0].value;
        const prénom = document.getElementsByName('prénom')[0].value;
        const email = document.getElementsByName('email')[0].value;
        const pass = document.getElementsByName('pass')[0].value;
        const datenaiss = document.getElementsByName('datenaiss')[0].value;
        const phone = document.getElementsByName('phone')[0].value;

        const errorContainer = document.getElementById('error-container');
        errorContainer.innerHTML = '';

        if (nom.trim() === '') {
            errors.push({field: 'nom', message: 'First Name is required.'});
        }

        if (prénom.trim() === '') {
            errors.push({field: 'prénom', message: 'Last Name is required.'});
        }

        if (email.trim() === '') {
            errors.push({field: 'email', message: 'Email is required.'});
        } else if (!isValidEmail(email)) {
            errors.push({field: 'email', message: 'Email should be in the format joe@gmail.com.'});
        }
        
        if (pass.trim() === '') {
            errors.push({field: 'pass', message: 'Password is required.'});
        }

        if (datenaiss.trim() === '') {
            errors.push({field: 'datenaiss', message: 'Date of birth is required.'});
        } else if (!isValidDate(datenaiss)) {
            errors.push({field: 'datenaiss', message: 'You must be at least 18 years old.'});
        }

        if (phone.trim() === '') {
            errors.push({field: 'phone', message: 'Phone number is required.'});
        }

        if (errors.length > 0) {
            event.preventDefault();
            displayErrors(errors);
        }
    });

    function isValidEmail(email) {
        const regex = /^[a-zA-Z0-9._-]+@gmail\.com$/;
        return regex.test(email);
    }

    function isValidDate(datenaiss) {
        const today = new Date();
        const birthDate = new Date(datenaiss);
        const age = today.getFullYear() - birthDate.getFullYear();
        const month = today.getMonth() - birthDate.getMonth();

        if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age >= 18;
    }

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
