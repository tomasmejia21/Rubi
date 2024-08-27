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
        var submitButton = document.getElementById('submit-button');
        var allowedExtensions = /(\.jpg|\.png|\.gif)$/i; // Extensiones permitidas
        var maxSize = 5 * 1024 * 1024; // Tamaño máximo 5MB

        var titleIsValid = !isEmpty(titleInput.value);
        var bodyIsValid = !isEmpty(bodyInput.value);
        var imageIsValid = imageInput.files.length > 0;
        var extensionIsValid = allowedExtensions.exec(imageInput.value);
        var sizeIsValid = imageIsValid && imageInput.files[0].size <= maxSize;

        // Validar el campo de nombre
        if (titleIsValid) {
            errorMessageTitle.innerHTML = '';
        } else {
            errorMessageTitle.innerHTML = 'El campo de nombre no puede estar vacío.';
            errorMessageTitle.style.color = 'crimson';
        }

        // Validar el campo de body
        if (bodyIsValid) {
            errorMessageBody.innerHTML = '';
        } else {
            errorMessageBody.innerHTML = 'El campo de nombre no puede estar vacío.';
            errorMessageBody.style.color = 'crimson';
        }

        // Validar que se haya seleccionado un archivo
        if (imageIsValid) {
            errorMessageImage.innerHTML = '';
        } else {
            errorMessageImage.innerHTML = 'Por favor, selecciona un archivo.';
            errorMessageImage.style.color = 'crimson';
        }

        // Validar la extensión del archivo
        if (imageIsValid && !extensionIsValid) {
            errorMessageImage.innerHTML = 'Solo se permiten archivos .pdf, .doc, .docx.';
            errorMessageImage.style.color = 'crimson';
            imageIsValid = false; // Establecer imageIsValid como falso si la extensión no es válida
        }

        // Validar el tamaño del archivo
        if (imageIsValid && !sizeIsValid) {
            errorMessageImage.innerHTML = 'El archivo es demasiado grande. El tamaño máximo permitido es 5MB.';
            errorMessageImage.style.color = 'crimson';
            imageIsValid = false; // Establecer imageIsValid como falso si el tamaño no es válido
        }

        // Desactivar o habilitar el botón de envío
        if (titleIsValid && bodyIsValid && imageIsValid && extensionIsValid && sizeIsValid) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
            event.preventDefault(); // Solo evita el envío si no es válido
        }
    }

    document.getElementById('title').addEventListener('input', validateFileInput);
    document.getElementById('body').addEventListener('input', validateFileInput);
    document.getElementById('image').addEventListener('change', validateFileInput);
    document.querySelector('form').addEventListener('submit', validateFileInput);
});