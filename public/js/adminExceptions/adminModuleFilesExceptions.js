document.addEventListener('DOMContentLoaded', () => {
    function isEmpty(value) {
        return value.trim() === ''; // Ignora los espacios en blanco
    }

    function validateFileInput(event) {
        var nameInput = document.getElementById('name');
        var fileInput = document.getElementById('file');
        var errorMessageName = document.getElementById('error-message-name');
        var errorMessageFile = document.getElementById('error-message-file');
        var submitButton = document.getElementById('submit-button');
        var allowedExtensions = /(\.pdf|\.doc|\.docx)$/i; // Extensiones permitidas
        var maxSize = 5 * 1024 * 1024; // Tamaño máximo 5MB

        var nameIsValid = !isEmpty(nameInput.value);
        var fileIsValid = fileInput.files.length > 0;
        var extensionIsValid = allowedExtensions.exec(fileInput.value);
        var sizeIsValid = fileIsValid && fileInput.files[0].size <= maxSize;

        // Validar el campo de nombre
        if (nameIsValid) {
            errorMessageName.innerHTML = '';
        } else {
            errorMessageName.innerHTML = 'El campo de nombre no puede estar vacío.';
            errorMessageName.style.color = 'crimson';
        }

        // Validar que se haya seleccionado un archivo
        if (fileIsValid) {
            errorMessageFile.innerHTML = '';
        } else {
            errorMessageFile.innerHTML = 'Por favor, selecciona un archivo.';
            errorMessageFile.style.color = 'crimson';
        }

        // Validar la extensión del archivo
        if (fileIsValid && !extensionIsValid) {
            errorMessageFile.innerHTML = 'Solo se permiten archivos .pdf, .doc, .docx.';
            errorMessageFile.style.color = 'crimson';
            fileIsValid = false; // Establecer fileIsValid como falso si la extensión no es válida
        }

        // Validar el tamaño del archivo
        if (fileIsValid && !sizeIsValid) {
            errorMessageFile.innerHTML = 'El archivo es demasiado grande. El tamaño máximo permitido es 5MB.';
            errorMessageFile.style.color = 'crimson';
            fileIsValid = false; // Establecer fileIsValid como falso si el tamaño no es válido
        }

        // Desactivar o habilitar el botón de envío
        if (nameIsValid && fileIsValid && extensionIsValid && sizeIsValid) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
            event.preventDefault(); // Solo evita el envío si no es válido
        }
    }

    document.getElementById('name').addEventListener('input', validateFileInput);
    document.getElementById('file').addEventListener('change', validateFileInput);
    document.querySelector('form').addEventListener('submit', validateFileInput);
});