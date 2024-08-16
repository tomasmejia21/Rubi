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

    function isEmpty(value) {
        return value === '';
    }

    function validateForm(event) {
        var emailInput = document.getElementById('email');
        var errorMessageEmail = document.getElementById('error-message-email');

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
    }
        
    document.getElementById('email').addEventListener('input', validateForm);
});