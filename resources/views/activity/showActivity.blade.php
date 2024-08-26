<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $activity->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/moduleActivityView.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <div class="container text-center">
        <div class="row">
          <div class="col"></div>
          <div class="col-6">
            <h1>{{ $activity->title }}</h1>
            <p>{{ $activity->description }}</p>
            <div class="image-container">
                <img src="{{ asset('storage/images/' . $activity->image) }}" class="img-fluid" alt="{{ $activity->title }}">
                @if($activity->voice_file)
                    <audio id="audioPlayer" src="{{ asset('storage/voices/' . $activity->voice_file) }}" style="display: none;"></audio>
                    <img class="audio-icon" src="{{ asset('images/audio_icon.png')}}" alt="Audio" onclick="playAudio()">
                @endif
            </div>
            <!-- Question and Options Preview -->
            <br>
            <div id="optionsPreview">
                @if($activity->question_type == 'cerrada')
                    <!-- Las opciones de respuesta se mostrarán aquí -->
                    @php
                        $responsesCount = count($responses);
                        $colClass = $responsesCount <= 3 ? 'col-md-4' : 'col-md-6';
                    @endphp
                    <div class="row">
                        @foreach($responses as $index => $response)
                            @if(($responsesCount == 4 || $responsesCount == 6) && $index % 2 == 0 && $index > 0)
                                </div>
                                <div class="row">
                            @endif
                            @if($responsesCount == 5 && $index % 3 == 0 && $index > 0)
                                </div>
                                <div class="row">
                            @endif
                            <div class="{{ $colClass }} response-card">
                                <div class="card">
                                    <div class="card-body">
                                        {{ $response->text }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @if($activity->question_type == 'abierta')
                <div id="textResponsePreview">
                    <input type="text" class="form-control" placeholder="Escribe tu respuesta aquí...">
                </div>
            @endif
            <div class="mt-3">
                <button type="button" class="btn btn-light" id="responseButton" disabled>Responder</button>
            </div>
          </div>
          <div class="col"></div>
        </div>
    </div>
    <script>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script></th>
</body>
</html>