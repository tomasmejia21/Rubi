document.addEventListener('DOMContentLoaded', () => {
    function isEmpty(value) {
        return value.trim() === ''; // Asegura que se ignoren los espacios en blanco
    }

    function validateForm(event) {
        var titleInput = document.getElementById('title');
        var descriptionInput = document.getElementById('description');
        var teacherSelect = document.getElementById('teacher');
        var errorMessageTitle = document.getElementById('error-message-title');
        var errorMessageDescription = document.getElementById('error-message-description');
        var errorMessageTeacher = document.getElementById('error-message-teacher');
        var submitButton = document.getElementById('submit-button');

        var titleIsValid = !isEmpty(titleInput.value);
        var descriptionIsValid = !isEmpty(descriptionInput.value);
        var teacherIsValid = teacherSelect.value !== '0';

        // Validar título
        if (titleIsValid) {
            errorMessageTitle.innerHTML = '';
        } else {
            errorMessageTitle.innerHTML = 'El campo está vacío';
            errorMessageTitle.style.color = 'crimson';
        }

        // Validar descripción
        if (descriptionIsValid) {
            errorMessageDescription.innerHTML = '';
        } else {
            errorMessageDescription.innerHTML = 'El campo está vacío';
            errorMessageDescription.style.color = 'crimson';
        }

        // Validar selección del profesor
        if (teacherIsValid) {
            errorMessageTeacher.innerHTML = '';
        } else {
            errorMessageTeacher.innerHTML = 'Por favor, selecciona una opción.';
            errorMessageTeacher.style.color = 'crimson';
        }

        // Desactivar o habilitar el botón de envío
        if (titleIsValid && descriptionIsValid && teacherIsValid) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
            event.preventDefault(); // Solo evita el envío si no es válido
        }
    }

    document.getElementById('title').addEventListener('input', validateForm);
    document.getElementById('description').addEventListener('input', validateForm); // Agregar validación en el campo descripción
    document.getElementById('teacher').addEventListener('change', validateForm);
    document.querySelector('form').addEventListener('submit', validateForm);
});