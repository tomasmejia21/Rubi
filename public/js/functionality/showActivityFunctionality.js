// Get the response button
var responseButton = document.getElementById('responseButton');

// Get all response cards
var responseCards = document.getElementsByClassName('response-card');

// Get the text input field
var textInput = document.querySelector('#textResponsePreview input');

// add input event listener to the text input field
textInput.addEventListener('input', function() {
    // Enable the response button if the input field is not empty
    responseButton.disabled = this.value.trim() === '';
});

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

// If the question type is 'abierta', add input event listener to the text input field
if('{{ $activity->question_type }}' == 'abierta') {
    var textResponsePreview = document.getElementById('textResponsePreview');

    textResponsePreview.querySelector('input').addEventListener('input', function() {
        // Enable the response button if the input field is not empty
        responseButton.disabled = this.value.trim() === '' ? true : false;
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