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
            <form action="{{route('activities.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Activity Details -->
                <div class="form-group">
                    <label for="moduleId">Módulo</label>
                    <select name="moduleId" class="form-control" id="moduleId">
                        <option value="0" selected disabled>-- Selecciona una opción --</option>
                        @foreach ($modules as $module)
                            <option value="{{ $module->moduleId }}">{{ $module->title }}</option>
                        @endforeach
                    </select>
                    <span id="error-message-module"></span>
                </div>
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" class="form-control" id="title" value="Actividad 1" oninput="updatePreview()">
                    <span id="error-message-title"></span>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" name="description" id="description" oninput="updatePreview()">En esta actividad...</textarea>
                    <span id="error-message-description"></span>
                </div>
                <br>
                <!-- Add a hidden input field in your form -->
                <input type="hidden" id="imageExists" value="{{ isset($activity) && $activity->image ? 'true' : 'false' }}">
                <!-- Image Upload -->
                <div class="form-group">
                    <label for="activityImage">Cargar Imagen</label>
                    <input type="file" id="activityImage" name="activityImage" onchange="previewImage(event)">
                    <label for="activityImage" class="btn btn-light" id="image-button">Seleccionar Imagen</label>
                    <span id="imageChosen">Ninguna imagen seleccionada</span>
                    <span id="error-message-image"></span>
                </div>
                <br>
                <!-- Additional Options -->
                <div class="form-group">
                    <label for="role_id">Rol</label>
                    <select class="form-control" id="role_id" name="role_id">
                        <option value="0" selected disabled>-- Selecciona una opción --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                    </select>
                    <span id="error-message-role"></span>
                </div>
                <br>
                <!-- Add a hidden input field in your form -->
                <input type="hidden" id="audioExists" value="{{ isset($activity) && $activity->voiceFile ? 'true' : 'false' }}">
                <div class="form-group">
                    <label for="voice">Redacción por voz</label>
                    <input type="checkbox" id="voice" name="voice" onchange="toggleVoiceInput()">
                    <input type="file" id="voiceFile" name="voiceFile" onchange="previewAudio(event)">
                    <label for="voiceFile" class="btn btn-light" id="voiceFileButton">Seleccionar audio</label>
                    <span id="fileChosen">Ningún audio seleccionado</span>
                    <span id="error-message-voice"></span>
                </div>
                <br>
                <!-- Question Type -->
                <div class="form-group">
                    <label for="questionType">Tipo de pregunta</label>
                    <select class="form-control" id="questionType" name="questionType" onchange="toggleResponseOptions()">
                        <option value="cerrada">Cerrada</option>
                        <option value="abierta">Abierta</option>
                    </select>
                </div>

                <!-- Response Type (Closed Questions Only) -->
                <div class="form-group" id="responseTypeGroup">
                    <label for="responseType">Respuesta</label>
                    <select class="form-control" id="response" name="response">
                        <!-- Este campo se rellenará dinámicamente para preguntas cerradas -->
                    </select>
                </div>
                <input type="hidden" id="isEditView" value="false">
                <!-- Response Count (Closed Questions Only) -->
                <div class="form-group" id="responseCountGroup">
                    <label for="responseCount">Cantidad de respuestas</label>
                    <input type="number" class="form-control" id="responseCount" name="responseCount" value="4" oninput="generateResponseFields()">
                    <span id="error-message-responses-count"></span>
                </div>
                <br>
                <!-- Dynamic Answer Options (Closed Questions Only) -->
                <div class="form-group" id="responsesGroup" name="respondesGroup">
                    <label>Respuestas</label>
                    <!-- Las opciones de respuesta se generarán dinámicamente aquí -->
                </div>
                <span id="error-message-responses"></span>
                <br>
                <!-- Submit Button -->
                <input type="submit" class="btn btn-light" name="save" value="Crear actividad" id="submit-button" disabled>
            </form>
        </div>

        <!-- Right Column: Activity Editor Preview -->
        <div class="col-md-8">
            <div class="card" id="middleDiv">
                <div class="card-header sectionTitle">
                    <h3>Vista previa</h2>
                </div>
                <div class="card-body">
                    <h5 class="card-title sectionTitle" id="preview-title">Actividad 1</h5>
                    <p class="card-text sectionTitle" id="preview-description">En esta actividad...</p>
                    <!-- Image Preview -->
                    <div id="imagePreviewContainer">
                        <img id="imagePreview" src="#" alt="Previsualización de la imagen">
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
    <script src="{{ asset('js/adminExceptions/adminActivityExceptions.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>