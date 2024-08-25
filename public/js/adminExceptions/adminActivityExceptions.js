document.addEventListener('DOMContentLoaded', (event) => {

    function isEmpty(value) {
        return value === '';
    }

    // Declare variables in the global scope
    var singleResponseIsValid = true;
    var responseCountIsValid = false; 
    // Function to validate a single response
    function validateResponse() {
        var errorMessageResponses = document.getElementById('error-message-responses');
        if (this.value.trim() === '') {
            errorMessageResponses.textContent = 'Todas las respuestas deben estar llenas.';
            errorMessageResponses.style.color = 'crimson';
            singleResponseIsValid = false;
        } else {
            // If the response is not empty, clear the error message
            errorMessageResponses.textContent = '';
            singleResponseIsValid = true;
        }
        validateForm(event);
    }

    function validateForm(event) {
        var moduleSelect = document.getElementById('moduleId');
        var titleInput = document.getElementById('title');
        var descriptionInput = document.getElementById('description');
        var imageInput = document.getElementById('activityImage');
        var imageChosen = document.getElementById('imageChosen');
        var imageExistsInput = document.getElementById('imageExists');
        var imageExists = imageExistsInput.value;
        var roleSelect = document.getElementById('role_id');
        var voiceInput = document.getElementById('voiceFile');
        var voiceCheckbox = document.getElementById('voice');
        var voiceExistsInput = document.getElementById('audioExists');
        var voiceExists = voiceExistsInput.value;
        
        var questionTypeSelect = document.getElementById('questionType');
        var responseCountInput = document.getElementById('responseCount');
        var errorMessageModule = document.getElementById('error-message-module');
        var errorMessageTitle = document.getElementById('error-message-title');
        var errorMessageDescription = document.getElementById('error-message-description');
        var errorMessageImage = document.getElementById('error-message-image');
        var errorMessageRole = document.getElementById('error-message-role');
        var errorMessageVoice = document.getElementById('error-message-voice');
        var errorMessageResponsesCount = document.getElementById('error-message-responses-count');
        var errorMessageResponses = document.getElementById('error-message-responses');
        var submitButton = document.getElementById('submit-button');

        var moduleIsValid = false;
        var titleIsValid = false;
        var descriptionIsValid = false;
        var imageIsValid = false;
        var roleIsValid = false;
        var voiceIsValid = false;
        var responsesIsValid = false;

        if (moduleSelect.value == '0') {
            submitButton.disabled = true;
            errorMessageModule.innerHTML = 'Por favor, selecciona una opción.';
            errorMessageModule.style.color = 'crimson';
            event.preventDefault();
        } else {
            if (errorMessageModule) {
                errorMessageModule.innerHTML = '';
            }
            moduleIsValid = true;
        }

        if (isEmpty(titleInput.value)) {
            if (errorMessageTitle) {
                submitButton.disabled = true;
                errorMessageTitle.innerHTML = 'El campo está vacío';
                errorMessageTitle.style.color = 'crimson';
            }
            event.preventDefault();
        } else {
            if (errorMessageTitle) {
                errorMessageTitle.innerHTML = '';
            }
            titleIsValid = true;
        }

        if (isEmpty(descriptionInput.value)) {
            if (errorMessageDescription) {
                submitButton.disabled = true;
                errorMessageDescription.innerHTML = 'El campo está vacío';
                errorMessageDescription.style.color = 'crimson';
            } 
            event.preventDefault();
        } else {
            if (errorMessageDescription) {
                errorMessageDescription.innerHTML = '';
            }
            descriptionIsValid = true;
        }
        
        // Check if an image file is selected
        if (imageInput.files.length > 0 || imageExists=='true') {
            // Get the selected image file
            var imageFile = imageInput.files[0];
            
            if (imageInput.files.length > 0) {
                // Check the file type of the selected file
                if (imageFile.type !== 'image/jpeg' && imageFile.type !== 'image/png') {
                    // If the file is not a jpg or png image, prevent form submission and show an error message
                    event.preventDefault();
                    errorMessageImage.textContent = 'Tipo de archivo incorrecto. Por favor, selecciona una imagen jpg o png.';
                    errorMessageImage.style.color = 'crimson';
                } else if (imageFile.size > 2 * 1024 * 1024) { // Check if the file size is more than 2 MB
                    // If the file is too large, prevent form submission and show an error message
                    event.preventDefault();
                    errorMessageImage.textContent = 'El archivo es demasiado grande. Por favor, selecciona una imagen de menos de 2 MB.';
                    errorMessageImage.style.color = 'crimson';
                } else {
                    // If the file is a valid image, clear the error message
                    errorMessageImage.textContent = '';
                    imageIsValid = true;
                }
            } else {
                // If no new image file is selected, clear the error message
                errorMessageImage.innerHTML = '';
                imageIsValid = true
            }      
        } else {
            // If no image file is selected, prevent form submission and show an error message
            submitButton.disabled = true;
            errorMessageImage.textContent = 'Por favor, selecciona una imagen.';
            errorMessageImage.style.color = 'crimson';
            event.preventDefault();
        } 

        if (roleSelect.value == "0") {
            submitButton.disabled = true;
            errorMessageRole.innerHTML = 'Por favor, selecciona una opción.';
            errorMessageRole.style.color = 'crimson';
            event.preventDefault();
        } else {
            errorMessageRole.innerHTML = '';
            roleIsValid = true;
        }

        // Check if the checkbox is checked
        if (voiceCheckbox.checked && voiceExists=='false') {
            // If the checkbox is checked, perform the validation
            if (voiceInput.files.length > 0) {
                var voiceFile = voiceInput.files[0];
                if (!voiceFile.type.startsWith('audio/')) {
                    // If the file is not an audio, prevent form submission and show an error message
                    event.preventDefault();
                    errorMessageVoice.textContent = 'Tipo de archivo incorrecto. Por favor, selecciona un archivo de audio.';
                    errorMessageVoice.style.color = 'crimson';
                } else if (voiceFile.size > 5 * 1024 * 1024) { // Check if the file size is more than 5 MB
                    // If the file is too large, prevent form submission and show an error message
                    event.preventDefault();
                    errorMessageVoice.textContent = 'El archivo es demasiado grande. Por favor, selecciona un archivo de audio de menos de 5 MB.';
                    errorMessageVoice.style.color = 'crimson';
                } else {
                    if (errorMessageVoice) {
                        errorMessageVoice.innerHTML = '';
                    }
                    voiceIsValid = true
                }
            } else {
                // If no file is selected, prevent form submission and show an error message
                event.preventDefault();
                errorMessageVoice.textContent = 'Por favor, selecciona un archivo de audio.';
                errorMessageVoice.style.color = 'crimson';
            }
        } else {
            // If the checkbox is not checked or no audio already exists, prevent form submission and show an error message, clear the error message
            if (errorMessageVoice) {
                errorMessageVoice.innerHTML = '';
            }
            voiceIsValid = true;
        }

        if (questionTypeSelect.value == 'cerrada') {
            // Get the number of responses
            var responseCount = parseInt(responseCountInput.value);

            // Check if the number of responses is in the valid range
            if (isEmpty(responseCountInput.value)) {
                event.preventDefault();
                errorMessageResponsesCount.textContent = 'El campo no puede ser vacío';
                errorMessageResponsesCount.style.color = 'crimson';
                event.preventDefault();
            } else if (responseCount < 2 || responseCount > 6) {
                event.preventDefault();
                errorMessageResponsesCount.textContent = 'El número de respuestas debe ser entre 2 y 6.';
                errorMessageResponsesCount.style.color = 'crimson';
                event.preventDefault();
            } else {
                errorMessageResponsesCount.textContent = '';
                responseCountIsValid = true;
            }

            // Add an input event listener to each response field
            for (var i = 1; i <= responseCount; i++) {
                var responseInput = document.getElementById('response' + i);
                if (responseInput) {
                    responseInput.addEventListener('input', function() {
                        // Check if the response is empty
                        if (this.value.trim() === '') {
                            errorMessageResponses.textContent = 'Todas las respuestas deben estar llenas.';
                            errorMessageResponses.style.color = 'crimson';
                            singleResponseIsValid = false;
                        } else {
                            // If the response is not empty, clear the error message
                            errorMessageResponses.textContent = '';
                            singleResponseIsValid = true;
                        }

                    });
                }
            }
        }
        
        if (responseCountIsValid && singleResponseIsValid) {
            responsesIsValid = true;
        }
        console.log(responsesIsValid);
        if (moduleIsValid && titleIsValid && descriptionIsValid && imageIsValid && roleIsValid && voiceIsValid && responsesIsValid) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
        
        event.preventDefault();

    }

    // Add an input event listener to each response field
    var responseCount = document.getElementById('responseCount').value;
    for (var i = 1; i <= responseCount; i++) {
        var responseInput = document.getElementById('response' + i);
        if (responseInput) {
            responseInput.addEventListener('input', validateResponse);
        }
    }

    document.getElementById('moduleId').addEventListener('change', validateForm);
    document.getElementById('title').addEventListener('input', validateForm);
    document.getElementById('description').addEventListener('input', validateForm);
    document.getElementById('activityImage').addEventListener('change', validateForm);
    document.getElementById('role_id').addEventListener('change', validateForm);
    document.getElementById('voiceFile').addEventListener('change', validateForm);
    document.getElementById('voice').addEventListener('change', validateForm);
    document.getElementById('questionType').addEventListener('change', validateForm);
    document.getElementById('responseCount').addEventListener('input', validateForm);
    document.querySelector('form').addEventListener('submit', validateForm);
});