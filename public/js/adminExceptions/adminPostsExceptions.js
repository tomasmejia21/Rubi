document.addEventListener('DOMContentLoaded', () => {
    function isEmpty(value) {
        return value.trim() === ''; // Ignora los espacios en blanco
    }

    function validateFileInput(event) {
        var titleInput = document.getElementById('title');
        var bodyInput = document.getElementById('body');
        var imageInput = document.getElementById('image');
        var errorMessageTitle = document.getElementById('error-message-title');
        var errorMessageBody = document.getElementById('error-message-body');
        var errorMessageImage = document.getElementById('error-message-image');
        var submitButton = document.getElementById('submit-button-create');
        var allowedExtensions = /(\.jpg|\.png|\.gif)$/i; // Extensiones permitidas
        var maxSize = 5 * 1024 * 1024; // Tamaño máximo 5MB

        var titleIsValid = !isEmpty(titleInput.value);
        var bodyIsValid = !isEmpty(bodyInput.value);
        var imageIsValid = imageInput.files.length > 0;
        var extensionIsValid = allowedExtensions.exec(imageInput.value);
        var sizeIsValid = imageIsValid && imageInput.files[0].size <= maxSize;

        // Validar el campo de nombre
        if (isEmpty(titleInput.value)) {
            errorMessageTitle.innerHTML = 'El campo de nombre no puede estar vacío.';
            errorMessageTitle.style.color = 'crimson';
        } else {
            errorMessageTitle.innerHTML = '';
            titleIsValid = true;
        }

        // Validar el campo de body
        if (isEmpty(bodyInput.value)) {
            errorMessageBody.innerHTML = 'El campo de nombre no puede estar vacío.';
            errorMessageBody.style.color = 'crimson';
        } else {
            errorMessageBody.innerHTML = '';
            bodyIsValid = true;
        }

        // Validar que se haya seleccionado un archivo
        if (imageInput.files.length === 0) {
            errorMessageImage.innerHTML = 'Por favor, selecciona un archivo.';
            errorMessageImage.style.color = 'crimson';
            event.preventDefault();
        } else {
            // Validar la extensión del archivo
            if (!allowedExtensions.exec(imageInput.value)) {
                errorMessageImage.innerHTML = 'Solo se permiten archivos .jpg, .png, .gif.';
                errorMessageImage.style.color = 'crimson';
                event.preventDefault();
            } else {
                // Validar el tamaño del archivo
                if (imageInput.files[0].size > maxSize) {
                    errorMessageImage.innerHTML = 'El archivo es demasiado grande. El tamaño máximo permitido es 5MB.';
                    errorMessageImage.style.color = 'crimson';
                    event.preventDefault();
                } else {
                    errorMessageImage.innerHTML = '';
                    imageIsValid = true;
                    extensionIsValid = true;
                    sizeIsValid = true;
                    // submitButton.disabled = false;
                }
            }
            
        }

        // Desactivar o habilitar el botón de envío
        if (titleIsValid && bodyIsValid && imageIsValid && extensionIsValid && sizeIsValid) {
            submitButton.disabled = false;
        }
    }

    document.getElementById('title').addEventListener('input', validateFileInput);
    document.getElementById('body').addEventListener('input', validateFileInput);
    document.getElementById('image').addEventListener('change', validateFileInput);
    document.querySelector('form').addEventListener('submit', validateFileInput);
});