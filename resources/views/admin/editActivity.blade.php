<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubí - Administrar actividades</title>
    <link rel="stylesheet" href="{{ asset('css/activityStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    <!-- Main Content -->
    <div class="row mt-4">
        <!-- Left Column: Form -->
        <div class="col-md-4">
            <form action="{{route('activities.update', $activity->activityId)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Activity Details -->
                <div class="form-group">
                    <label for="moduleId">Módulo</label>
                    <input type="text" name="moduleId" class="form-control" id="moduleId" value="{{ old('moduleId', $activity->moduleId) }}">
                </div>
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $activity->title) }}" oninput="updatePreview()">
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" name="description" id="description" oninput="updatePreview()">{{ old('description', $activity->description) }}</textarea>
                </div>
                <br>
                <!-- Image Upload -->
                <div class="form-group">
                    <label for="activityImage">Cargar Imagen</label>
                    <input type="file" id="activityImage" name="activityImage" onchange="previewImage(event)">
                    <label for="activityImage" class="btn btn-light" id="image-button">Seleccionar Imagen</label>
                    <span id="imageChosen">
                        @if(old('activityImage'))
                            {{ old('activityImage') }}
                        @else
                            {{ $activity->image ? $activity->image : 'Ninguna imagen seleccionada' }}
                        @endif
                    </span>
                </div>
                <br>
                <!-- Additional Options -->
                <div class="form-group">
                    <label for="role_id">Rol</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="0" selected disabled>-- Selecciona una opción --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ (old('role_id') ? old('role_id') : $activity->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label for="voice">Redacción por voz</label>
                    <input type="checkbox" id="voice" name="voice" onchange="toggleVoiceInput()" {{ old('voice', $activity->voice) ? 'checked' : '' }}>
                    <input type="file" id="voiceFile" name="voiceFile" onchange="previewAudio(event)">
                    <label for="voiceFile" class="btn btn-light" id="voiceFileButton">Seleccionar audio</label>
                    <span id="fileChosen">
                        @if(old('voiceFile'))
                            {{ old('voiceFile') }}
                        @else
                            {{ $activity->voice_file ? $activity->voice_file : 'Ningún audio seleccionado' }}
                        @endif
                    </span>
                </div>
                <br>
                <!-- Question Type -->
                <div class="form-group">
                    <label for="questionType">Tipo de pregunta</label>
                    <select class="form-control" id="questionType" name="questionType" onchange="toggleResponseOptions()">
                        <option value="cerrada" {{ (old('questionType') ? old('questionType') : $activity->question_type) == 'cerrada' ? 'selected' : '' }}>Cerrada</option>
                        <option value="abierta" {{ (old('questionType') ? old('questionType') : $activity->question_type) == 'abierta' ? 'selected' : '' }}>Abierta</option>
                    </select>
                </div>

                <!-- Response Type (Closed Questions Only) -->
                <div class="form-group" id="responseTypeGroup">
                    <label for="responseType">Respuesta</label>
                    <select class="form-control" id="response" name="response">
                        <!-- Este campo se rellenará dinámicamente para preguntas cerradas -->
                    </select>
                </div>

                <!-- Response Count (Closed Questions Only) -->
                <div class="form-group" id="responseCountGroup">
                    <label for="responseCount">Cantidad de respuestas</label>
                    <input type="number" class="form-control" id="responseCount" name="responseCount" value="{{ old('responseCount', $activity->response_count) }}" oninput="generateResponseFields()">
                </div>
                <br>
                <!-- Dynamic Answer Options (Closed Questions Only) -->
                <div class="form-group" id="responsesGroup" name="respondesGroup">
                    <label>Respuestas</label>
                    <!-- Las opciones de respuesta se generarán dinámicamente aquí -->
                </div>
                <br>
                <!-- Submit Button -->
                <input type="submit" class="btn btn-light" name="save" value="Actualizar actividad" id="submit-button">
            </form>
        </div>

        <!-- Right Column: Activity Editor Preview -->
        <div class="col-md-8">
            <div class="card" id="middleDiv">
                <div class="card-header sectionTitle">
                    <h3>Vista previa</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title sectionTitle" id="preview-title">{{ $activity->title }}</h5>
                    <p class="card-text sectionTitle" id="preview-description">{{ $activity->description }}</p>
                    <!-- Image Preview -->
                    <div id="imagePreviewContainer">
                        <img id="imagePreview" src="{{ asset('storage/images/' . $activity->image) }}" alt="Previsualización de la imagen">
                        <audio id="audioPlayer" src="{{ asset('storage/voices/' . $activity->voice_file) }}" style="display: none;"></audio>
                        <img id="audioIcon" src="{{ asset('images/audio_icon.png')}}" alt="Audio" onclick="playAudio()">
                    </div>
                    <br>
                    <!-- Question and Options Preview -->
                    <div id="optionsPreview">
                        <div class="row" id="optionsContainer">
                            <!-- Las opciones de respuesta se mostrarán aquí -->
                        </div>
                    </div>
                    <div id="textResponsePreview">
                        <input type="text" class="form-control" placeholder="Escribe tu respuesta aquí...">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/functionality/createActivityFunctionality.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>