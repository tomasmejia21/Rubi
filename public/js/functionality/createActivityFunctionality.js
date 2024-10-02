var audioFile;

// Initialize the form
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.href.indexOf('activities/create') === -1) { // Check if the URL does not contain 'activities/create'
        toggleResponseOptions(); // Set up initial state based on default values

        // Load the previous image
        var imagePreview = document.getElementById('imagePreview');
        if (imagePreview) {
            imagePreview.style.display = 'block';
        }

        // Load the previous audio
        var audioPlayer = document.getElementById('audioPlayer');
        var audioIcon = document.getElementById('audioIcon');
        if (audioPlayer && audioIcon) {
            audioFile = new Audio(audioPlayer.src);
            audioIcon.style.display = 'block';
        }
    }
});

document.querySelector('#activityImage').addEventListener('change', function() {
    document.querySelector('#imageChosen').textContent = this.files[0].name;
});

document.querySelector('#voiceFile').addEventListener('change', function() {
    document.querySelector('#fileChosen').textContent = this.files[0].name;
});

// Function to update the preview dynamically
function updatePreview() {
    document.getElementById('preview-title').innerText = document.getElementById('title').value;
    document.getElementById('preview-description').innerText = document.getElementById('description').value;

    var questionType = document.getElementById('questionType').value;
    var response = document.getElementById('response');
    response.innerHTML = ''; // Clear existing options

    if (questionType === 'cerrada') {
        var responseCount = document.getElementById('responseCount').value;
        for (var i = 1; i <= responseCount; i++) {
            var responseInput = document.getElementById('response' + i);
            if (responseInput) {
                // Update preview
                document.getElementById('preview-option' + i).innerText = responseInput.value;

                // Update response select options
                var option = document.createElement('option');
                option.value = responseInput.value;
                option.text = responseInput.value;
                response.appendChild(option);
            }
        }
    }
}

// Function to preview the image when selected
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('imagePreview');
        output.src = '';  // This will "destroy" the previous image
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}

// Function to handle voice input toggle
function toggleVoiceInput() {
    var voiceFileInput = document.getElementById('voiceFile');
    var voiceFileButton = document.getElementById('voiceFileButton');
    var fileChosen = document.getElementById('fileChosen');
    var audioIcon = document.getElementById('audioIcon');

    var isChecked = document.getElementById('voice').checked;

    voiceFileInput.style.display = 'none';
    voiceFileButton.style.display = isChecked ? 'inline-block' : 'none';
    fileChosen.style.display = isChecked ? 'inline-block' : 'none';
    audioIcon.style.display = isChecked ? 'block' : 'none';

    if (!isChecked && audio) {
        audio.pause();
        audio.currentTime = 0;  // This will restart the audio from the beginning
        audio = null;
        fileChosen.textContent = 'Ningún archivo seleccionado';  // Reset the file chosen text
    }
}

// Function to preview audio icon when audio file is uploaded
function previewAudio(event) {
    audioFile = event.target.files[0];
    document.getElementById('audioIcon').style.display = 'block';
}

var audio = null;

// Function to play audio
function playAudio() {
    if (window.location.href.indexOf('activities/create') !== -1) {  // If the URL contains 'activities/create'
        if (audioFile) {
            if (audio) {
                if (!audio.paused) {
                    audio.pause();
                    audio.currentTime = 0;  // This will restart the audio from the beginning
                    audio = null;
                }
            } else {
                audio = new Audio(URL.createObjectURL(audioFile));
                audio.play();
            }
        }
    } else {  // If the URL does not contain 'activities/create'
        var audioPlayer = document.getElementById('audioPlayer');
        if (audioPlayer) {
            if (!audioPlayer.paused) {
                audioPlayer.pause();
                audioPlayer.currentTime = 0;  // This will restart the audio from the beginning
            } else {
                audioPlayer.play().catch(function(error) {
                    console.error('Failed to play audio:', error);  // Log any errors that occur when trying to play the audio
                });
            }
        }
    }
}

// Function to toggle response options based on question type
function toggleResponseOptions() {
    var questionType = document.getElementById('questionType').value;
    var responsesGroup = document.getElementById('responsesGroup');
    var responseCountGroup = document.getElementById('responseCountGroup');
    var responseTypeGroup = document.getElementById('responseTypeGroup');
    var optionsPreview = document.getElementById('optionsPreview');
    var textResponsePreview = document.getElementById('textResponsePreview');
    var responseField = document.getElementById('response'); // Get the response field

    if (questionType === 'cerrada') {
        responseTypeGroup.style.display = 'block';
        responseCountGroup.style.display = 'block';
        responsesGroup.style.display = 'block';
        optionsPreview.style.display = 'block';
        textResponsePreview.style.display = 'none';
        generateResponseFields();
    } else if (questionType === 'abierta') {
        responseTypeGroup.style.display = 'none'; // Hide response type group
        responseCountGroup.style.display = 'none'; // Hide response count group
        responsesGroup.style.display = 'none'; // Hide responses group
        optionsPreview.style.display = 'none'; // Hide options preview
        textResponsePreview.style.display = 'block'; // Show text input for open-ended question

        // Set the value of the response fields to null
        var responseInputs = responsesGroup.getElementsByTagName('input');
        for (var i = 0; i < responseInputs.length; i++) {
            responseInputs[i].value = null;
        }

        // Set the value of the response count to null
        responseCountGroup.getElementsByTagName('input')[0].value = null;

        // Set the value of the response field to null
        if (responseField) {
            responseField.value = null;
        }
    }
}
function generateResponseFields() {
    var responseCount = document.getElementById('responseCount').value;
    var responsesGroup = document.getElementById('responsesGroup');
    var optionsContainer = document.getElementById('optionsContainer');
    var isEditView = document.getElementById('isEditView').value === 'true';
    var correctAnswer = isEditView ? document.getElementById('correctAnswer').value : null; // Get the correct answer only in edit view
    responsesGroup.innerHTML = ''; // Clear existing response fields
    optionsContainer.innerHTML = ''; // Clear existing options in preview
    var responseCount = parseInt(responseCount, 10); // Convert responseCount to a number
    if (responseCount >= 2 && responseCount <= 6) {
        for (var i = 1; i <= responseCount; i++) {
            // Create input field for response
            var input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control mb-2';
            input.name = 'responses[]';
            input.id = 'response' + i;
            if (isEditView) {
                var oldResponse = document.getElementById('oldResponse' + i);
                if (oldResponse) {
                    input.value = oldResponse.value;
                } else {
                    input.value = 'Opción ' + i;
                }
            } else {
                input.value = 'Opción ' + i;
            }
            input.oninput = updatePreview; // Update preview on input
            responsesGroup.appendChild(input);
    
            // Add corresponding option in the preview
            var col = document.createElement('div');
            col.className = 'col-md-6 mb-2';
            var optionPreview = document.createElement('button');
            optionPreview.type = 'button';
            optionPreview.className = 'btn btn-outline-primary btn-block';
            optionPreview.id = 'preview-option' + i;
            optionPreview.innerText = input.value;
            if (input.value === correctAnswer) {
                optionPreview.classList.add('selected'); // Add a 'selected' class to the correct answer
            }
            col.appendChild(optionPreview);
            optionsContainer.appendChild(col);
        }
    }
    updateResponseField(); // Update response type options
}

function updateResponseField() {
    var responseType = document.getElementById('response');
    var responseCount = document.getElementById('responseCount').value;
    var isEditView = document.getElementById('isEditView').value === 'true';
    var correctAnswer = isEditView ? document.getElementById('correctAnswer').value : null; // Get the correct answer only in edit view
    responseType.innerHTML = ''; // Clear existing options
    for (var i = 1; i <= responseCount; i++) {
        var option = document.createElement('option');
        var responseInput = document.getElementById('response' + i);
        option.value = responseInput.value;
        option.text = responseInput.value;
        if (responseInput.value === correctAnswer) {
            option.selected = true;
        }
        responseType.appendChild(option);
    }
}

// Initialize the form
document.addEventListener('DOMContentLoaded', function() {
    toggleResponseOptions(); // Set up initial state based on default values
    toggleVoiceInput(); // Set up initial state based on default values
});