document.addEventListener('DOMContentLoaded', (event) => {
    function validateEmail(email) {
        // Esta es una expresión regular (regex) que define el patrón que debe seguir una dirección de correo electrónico.
        // Explicación del patrón:
        // ^ - Inicio de la línea.
        // (([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*) - Parte local del correo electrónico, antes del @. Puede contener cualquier carácter excepto los especiales <, >, (), [], \\, ,, ;, :, @, " y espacios. También puede contener puntos, pero no consecutivos ni al inicio o al final.
        // |(".+")) - O la parte local puede estar entre comillas, en cuyo caso puede contener cualquier carácter excepto las comillas.
        // @ - El símbolo @.
        // ((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\]) - El dominio puede ser una dirección IP entre corchetes.
        // |(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,})) - O el dominio puede ser una serie de subdominios separados por puntos, seguidos de un dominio de nivel superior de al menos dos letras.
        // $ - Fin de la línea.
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function checkEmail(email, callback) {
        $.ajax({
            url: '/check-email',
            type: 'GET',
            data: {email: email},
            success: function(response) {
                callback(response.emailExists);
            }
        });
    }

    function validatePassword(password) {
        // Esta es una expresión regular (regex) que define el patrón que debe seguir una contraseña.
        // Explicación del patrón:
        // ^ - Inicio de la línea.
        // (?=.*\d) - Debe contener al menos un dígito.
        // .{5,} - Debe contener al menos 5 caracteres.
        // $ - Fin de la línea.
        var re = /^(?=.*\d).{5,}$/;

        return re.test(password);
    }

    function isEmpty(value) {
        return value === '';
    }

    function isRecaptchaValid() {
        return grecaptcha.getResponse() !== '';
    }

    function handleSubmit(event) {
        if (!isRecaptchaValid()) {
            event.preventDefault();
            alert('Debes realizar el CAPTCHA para continuar');
        }
    }

    function validateForm(event) {
        var nameInput = document.getElementById('name');
        var institution = document.getElementById('institution');
        var role = document.getElementById('role_id');
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('password_confirmation');
        var errorMessageName = document.getElementById('error-message-name');
        var errorMessageInstitution = document.getElementById('error-message-institution');
        var errorMessageRole = document.getElementById('error-message-role');
        var errorMessageEmail = document.getElementById('error-message-email');
        var errorMessagePassword = document.getElementById('error-message-password');
        var errorMessageConfirmPassword = document.getElementById('error-message-confirmpassword');
        var submitButton = document.getElementById('submit-button');
        // Name regex
        var nameRegex = /^[a-zA-Z]+(\s[a-zA-Z]+)+$/;
        // Variables de validación
        var nameIsValid = false;
        var institutionIsValid = false;
        var roleIsValid = false;
        var emailIsValid = false;
        var passwordIsValid = false;
        var confirmPasswordIsValid = false;

        if (isEmpty(nameInput.value)) {
            if (errorMessageName) {
                submitButton.disabled = true;
                errorMessageName.innerHTML = 'El campo está vacío';
                errorMessageName.style.color = 'crimson';
            }
            event.preventDefault();
        } else if (!nameRegex.test(nameInput.value)) {
                if (errorMessageName) {
                    submitButton.disabled = true;
                    errorMessageName.innerHTML = 'Por favor, ingresa un nombre válido.';
                    errorMessageName.style.color = 'crimson';
                }
                event.preventDefault();
            }   
          else {
            if (errorMessageName) {
                errorMessageName.innerHTML = '';
            }
            nameIsValid = true;
        }

        if (institution.value == "0") {
            submitButton.disabled = true;
            errorMessageInstitution.innerHTML = 'Por favor, selecciona una opción.';
            errorMessageInstitution.style.color = 'crimson';
            event.preventDefault();
        } else {
            errorMessageInstitution.innerHTML = '';
            institutionIsValid = true;
        }

        if (role.value == "0") {
            submitButton.disabled = true;
            errorMessageRole.innerHTML = 'Por favor, selecciona una opción.';
            errorMessageRole.style.color = 'crimson';
            event.preventDefault();
        } else {
            errorMessageRole.innerHTML = '';
            roleIsValid = true;
        }

        if (isEmpty(passwordInput.value)) {
            if (errorMessagePassword) {
                submitButton.disabled = true;
                errorMessagePassword.innerHTML = 'El campo está vacío';
                errorMessagePassword.style.color = 'crimson';
            }
            event.preventDefault();
        } else if (!validatePassword(passwordInput.value)) {
            if (errorMessagePassword) {
                submitButton.disabled = true;
                errorMessagePassword.innerHTML = 'La contraseña debe tener al menos 5 caracteres y contener al menos un número';
                errorMessagePassword.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessagePassword) {
                errorMessagePassword.innerHTML = '';
            }
            passwordIsValid = true;
        }

        if (isEmpty(confirmPasswordInput.value)) {
            if (errorMessageConfirmPassword) {
                submitButton.disabled = true;
                errorMessageConfirmPassword.innerHTML = 'El campo está vacío';
                errorMessageConfirmPassword.style.color = 'crimson';
            }
            event.preventDefault();
        } else if (passwordInput.value !== confirmPasswordInput.value) {
            if (errorMessageConfirmPassword) {
                submitButton.disabled = true;
                errorMessageConfirmPassword.innerHTML = 'La confirmación de la contraseña no coincide';
                errorMessageConfirmPassword.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageConfirmPassword) {
                errorMessageConfirmPassword.innerHTML = '';
            }
            confirmPasswordIsValid = true;
        }

        if (isEmpty(emailInput.value)) {
            if (errorMessageEmail) {
                submitButton.disabled = true;
                errorMessageEmail.innerHTML = 'El campo está vacío';
                errorMessageEmail.style.color = 'crimson';
            }
            event.preventDefault();
        } else if (!validateEmail(emailInput.value)) {
            if (errorMessageEmail) {
                submitButton.disabled = true;
                errorMessageEmail.innerHTML = 'No se cumple la estructura de email';
                errorMessageEmail.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            checkEmail(emailInput.value, function(emailExists) {
                if (emailExists) {
                    if (errorMessageEmail) {
                        submitButton.disabled = true;
                        errorMessageEmail.innerHTML = 'El correo electrónico ya está en uso.';
                        errorMessageEmail.style.color = 'crimson';
                    }
                    event.preventDefault();
                } else {
                    if (errorMessageEmail) {
                        errorMessageEmail.innerHTML = '';
                    }
                    emailIsValid = true;
                }

                if (nameIsValid && institutionIsValid && emailIsValid && passwordIsValid && confirmPasswordIsValid && roleIsValid) {
                    submitButton.disabled = false;
                }
            });
        }

    }

    document.getElementById('name').addEventListener('input', validateForm);
    document.getElementById('institution').addEventListener('change', validateForm);
    document.getElementById('role_id').addEventListener('change', validateForm);
    document.getElementById('email').addEventListener('input', validateForm);
    document.getElementById('password').addEventListener('input', validateForm);
    document.getElementById('password_confirmation').addEventListener('input', validateForm);
    document.querySelector('form').addEventListener('submit', handleSubmit);
});