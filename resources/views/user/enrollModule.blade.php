<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulos</title>
    <link rel="stylesheet" href="{{ asset('css/enrollModuleStyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    
    <div class="container my-5">
        <div class="mt-4">
            <div id="modulesContainer" class="d-flex flex-wrap">
                <!-- Iterar sobre los módulos obtenidos de la base de datos -->
                @foreach($modules as $module)
                <div class="module-container">
                    <a class="module-circle">
                        {{ $module->title }}
                    </a>
                    <div class="module-description">
                        {{ $module->description }}
                    </div>
                    <div>
                        <form action="{{ route('modules.subscribe', $module->moduleId) }}" method="POST" class="d-inline">
                            @csrf
                            <br>
                            <button id="submit-button" type="submit" class="btn btn-light">
                                Inscribirse
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>