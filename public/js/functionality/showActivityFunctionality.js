// Get the response button
var responseButton = document.getElementById('responseButton');

// Get all response cards
var responseCards = document.getElementsByClassName('response-card');

// Add click event listener to each card
for (var i = 0; i < responseCards.length; i++) {
    responseCards[i].addEventListener('click', function() {
        // Remove highlight from all cards
        for (var j = 0; j < responseCards.length; j++) {
            responseCards[j].querySelector('.card').style.backgroundColor = 'white';
            responseCards[j].querySelector('.card').style.color = 'black';
        }

        // Highlight the clicked card
        this.querySelector('.card').style.backgroundColor = 'crimson';
        this.querySelector('.card').style.color = 'white';

        // Enable the response button
        responseButton.disabled = false;
    });
}


// Get the question type from the data attribute
var questionType = document.querySelector('#textResponsePreview').dataset.questionType;

// If the question type is 'abierta', get the text input field
if(questionType == 'abierta') {
    // Get the text input field
    var textInput = document.querySelector('#textResponsePreview input');

    // Get the response button
    var responseButton = document.getElementById('responseButton');

    // add input event listener to the text input field
    textInput.addEventListener('input', function() {
        // Enable the response button if the input field is not empty
        responseButton.disabled = this.value.trim() === '';
    });
}

// Play audio
function playAudio() {
    var audioPlayer = document.getElementById('audioPlayer');
    if (audioPlayer.paused) {
        audioPlayer.play();
    } else {
        audioPlayer.currentTime = 0;
        audioPlayer.pause();
    }
}

function selectAnswer(element) {
// Deselecciona la respuesta anterior
    var selected = document.querySelector('.selected');
    if (selected) {
        selected.classList.remove('selected');
        selected.querySelector('input').checked = false;
    }

    // Selecciona la nueva respuesta
    element.classList.add('selected');
    element.querySelector('input').checked = true;
}