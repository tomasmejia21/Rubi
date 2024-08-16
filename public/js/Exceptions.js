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

    function validateForm(event) {
        var nameInput = document.getElementById('name');
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');
        var errorMessageName = document.getElementById('error-message-name');
        var errorMessageEmail = document.getElementById('error-message-email');
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

        if (isEmpty(emailInput.value)) {
            if (errorMessageEmail) {
                errorMessageEmail.innerHTML = 'El campo está vacío';
                errorMessageEmail.style.color = 'crimson';
            }
            event.preventDefault();
        } else if (!validateEmail(emailInput.value)) {
            if (errorMessageEmail) {
                errorMessageEmail.innerHTML = 'No se cumple la estructura de email';
                errorMessageEmail.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageEmail) {
                errorMessageEmail.innerHTML = '';
            }
        }

        if (isEmpty(passwordInput.value)) {
            if (errorMessagePassword) {
                errorMessagePassword.innerHTML = 'El campo está vacío';
                errorMessagePassword.style.color = 'crimson';
            }
            event.preventDefault();
        } else if (!validatePassword(passwordInput.value)) {
            if (errorMessagePassword) {
                errorMessagePassword.innerHTML = 'La contraseña debe tener al menos 5 caracteres y contener al menos un número';
                errorMessagePassword.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessagePassword) {
                errorMessagePassword.innerHTML = '';
            }
        }
    }

    document.getElementById('name').addEventListener('input', validateForm);
    document.getElementById('email').addEventListener('input', validateForm);
    document.getElementById('password').addEventListener('input', validateForm);
    document.querySelector('form').addEventListener('submit', validateForm);
});