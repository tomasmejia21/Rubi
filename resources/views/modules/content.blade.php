<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $module -> title }}</title>
    <link rel="stylesheet" href="{{ asset('css/adminStyles/adminModulesStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    <div class="container my-5">
        <!-- Button trigger modal -->
        @if (session('role_id')==1 || session('role_id')==2)
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Nuevo archivo</button>
            <a href="/activities" id="action-button" class="btn btn-light">Agregar actividades</a>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="{{ route('modules.storeFile', $module -> moduleId) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo archivo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control">
                                <span id="error-message-name"></span>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Archivo</label>
                                <div class="input-group">
                                    <label class="input-group-text" for="file">Subir</label>
                                    <input type="text" class="form-control" readonly placeholder="Selecciona un archivo" id="fileDisplay">  
                                    <input class="form-control" type="file" id="file" name="file" style="display: none;" onchange="document.getElementById('fileDisplay').value = this.files[0].name">
                                </div>
                                <span id="error-message-file"></span>
                            </div>
                            


                        </div>
                        <div id="error-message"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                            <button type="submit" class="btn" id="submit-button" disabled>Subir</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container text-center">
        <h1 class="info-module">Modulo: {{$module -> title}}</h1>
        <p class="info-module">Descripcion: {{$module -> description}}</p>

    </div>
    <div class="container my-5">
        <!-- Mostrar archivos subidos -->
        <h2 class="info-module">Archivos Subidos</h2>
        <ul class="info-module">
            @foreach($files as $file)
                <li>
                    @if (pathinfo($file->file_url, PATHINFO_EXTENSION) === 'pdf')
                        <a href="{{ asset('storage/' . $file->file_url) }}" target="_blank">{{ $file->name }}</a>
                        <form action="{{ route('modules.destroyFile', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-hover-crimson">
                                <i class="bi bi-trash-fill text-white"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ asset('storage/' . $file->file_url) }}" download>{{ $file->name }}</a>
                        <form action="{{ route('modules.destroyFile', $file->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-hover-crimson">
                                <i class="bi bi-trash-fill text-white"></i>
                            </button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div class="container my-5">
        <h2 class="info-module">Actividades</h2>
        <!-- Mostrar actividades -->
        <div class="container my-5">
            <!-- Mostrar actividades -->
            <ul>
                @foreach ($activities as $activity)
                    <li>
                        <form action="{{ route('activity.show', ['id' => $activity->activityId]) }}" method="GET">
                            @csrf
                            <button id="activity-button" type="submit" class="btn btn-light activity-button">
                                {{ $activity->title }}
                            </button>
                        </form>
                    </li>
                    <br>
                @endforeach
            </ul>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminExceptions/adminModuleFilesExceptions.js')}}"></script>
</body>
</html>