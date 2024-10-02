document.addEventListener('DOMContentLoaded', (event) => {
    var originalEmail = document.getElementById('email').value;

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function checkEmail(email, callback) {
        $.ajax({
            url: '/check-email',
            type: 'GET',
            data: { email: email },
            success: function (response) {
                callback(response.emailExists);
            }
        });
    }

    function validatePassword(password) {
        var re = /^(?=.*\d).{5,}$/;
        return re.test(password);
    }

    function isEmpty(value) {
        return value === '';
    }

    function validateForm(event) {
        var nameInput = document.getElementById('name');
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('confirmpassword');
        var errorMessageName = document.getElementById('error-message-name');
        var errorMessageEmail = document.getElementById('error-message-email');
        var errorMessagePassword = document.getElementById('error-message-password');
        var errorMessageConfirmPassword = document.getElementById('error-message-confirmpassword');
        var submitButton = document.getElementById('submit-button');

        var nameRegex = /^[a-zA-Z]+(\s[a-zA-Z]+)+$/;
        var nameIsValid = false;
        var emailIsValid = false;
        var passwordIsValid = false;
        var confirmPasswordIsValid = false;

        // Validación del nombre
        if (isEmpty(nameInput.value)) {
            submitButton.disabled = true;
            errorMessageName.innerHTML = 'El campo está vacío';
            errorMessageName.style.color = 'crimson';
            event.preventDefault();
            return;
        } else if (!nameRegex.test(nameInput.value)) {
            submitButton.disabled = true;
            errorMessageName.innerHTML = 'Por favor, ingresa un nombre válido.';
            errorMessageName.style.color = 'crimson';
            event.preventDefault();
            return;
        } else {
            errorMessageName.innerHTML = '';
            nameIsValid = true;
        }

        // Validación de la contraseña
        if (isEmpty(passwordInput.value)) {
            errorMessagePassword.innerHTML = '';
            passwordIsValid = true;
        } else if (!validatePassword(passwordInput.value)) {
            submitButton.disabled = true;
            errorMessagePassword.innerHTML = 'La contraseña debe tener al menos 5 caracteres y contener al menos un número';
            errorMessagePassword.style.color = 'crimson';
            event.preventDefault();
            return;
        } else {
            errorMessagePassword.innerHTML = '';
            passwordIsValid = true;
        }

        // Validación de confirmación de la contraseña
        if (passwordInput.value !== confirmPasswordInput.value) {
            submitButton.disabled = true;
            errorMessageConfirmPassword.innerHTML = 'La confirmación de la contraseña no coincide';
            errorMessageConfirmPassword.style.color = 'crimson';
            event.preventDefault();
            return;
        } else {
            errorMessageConfirmPassword.innerHTML = '';
            confirmPasswordIsValid = true;
        }

        // Validación del correo electrónico
        if (isEmpty(emailInput.value)) {
            submitButton.disabled = true;
            errorMessageEmail.innerHTML = 'El campo está vacío';
            errorMessageEmail.style.color = 'crimson';
            event.preventDefault();
            return;
        } else if (!validateEmail(emailInput.value)) {
            submitButton.disabled = true;
            errorMessageEmail.innerHTML = 'No se cumple la estructura de email';
            errorMessageEmail.style.color = 'crimson';
            event.preventDefault();
            return;
        } else if (emailInput.value !== originalEmail) {
            checkEmail(emailInput.value, function (emailExists) {
                if (emailExists) {
                    submitButton.disabled = true;
                    errorMessageEmail.innerHTML = 'El correo electrónico ya está en uso.';
                    errorMessageEmail.style.color = 'crimson';
                } else {
                    errorMessageEmail.innerHTML = '';
                    emailIsValid = true;
                }

                if (nameIsValid && emailIsValid && passwordIsValid && confirmPasswordIsValid) {
                    submitButton.disabled = false;
                }
            });
            event.preventDefault();
            return; // Evitar que el formulario se envíe hasta que la validación AJAX se complete.
        } else {
            // Si el correo no ha cambiado pero es válido, limpiar el mensaje de error
            errorMessageEmail.innerHTML = '';
            emailIsValid = true;
        }

        // Habilitar el botón de envío si todo es válido
        if (nameIsValid && emailIsValid && passwordIsValid && confirmPasswordIsValid) {
            submitButton.disabled = false;
        } else {
            event.preventDefault(); // Prevenir el envío si no todos los campos son válidos.
        }
    }

    document.getElementById('name').addEventListener('input', validateForm);
    document.getElementById('email').addEventListener('input', validateForm);
    document.getElementById('password').addEventListener('input', validateForm);
    document.getElementById('confirmpassword').addEventListener('input', validateForm);
    document.querySelector('form').addEventListener('submit', validateForm);
});
