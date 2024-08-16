document.addEventListener('DOMContentLoaded', (event) => {

    function isEmpty(value) {
        return value === '';
    }

    function validateForm(event) {
        var nameInput = document.getElementById('username');
        var passwordInput = document.getElementById('password');
        var errorMessageName = document.getElementById('error-message-username');
        var errorMessagePassword = document.getElementById('error-message-password');

        if (isEmpty(nameInput.value)) {
            if (errorMessageName) {
                errorMessageName.innerHTML = 'El campo está vacío';
                errorMessageName.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageName) {
                errorMessageName.innerHTML = '';
            }
        }

        if (isEmpty(passwordInput.value)) {
            if (errorMessagePassword) {
                errorMessagePassword.innerHTML = 'El campo está vacío';
                errorMessagePassword.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessagePassword) {
                errorMessagePassword.innerHTML = '';
            }
        }
    }

    document.getElementById('username').addEventListener('input', validateForm);
    document.getElementById('password').addEventListener('input', validateForm);
    document.querySelector('form').addEventListener('submit', validateForm);
});