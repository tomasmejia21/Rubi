<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Módulo</title>
    <link rel="stylesheet" href="{{ asset('css/adminStyles/adminModulesStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    <div class="container-fluid p-0 text-center">
        <br>
        <div class="row">
            <div class="col"></div>
            <div class="col" id="middleDiv">
                <form action="{{route('modules.update', $module -> moduleId)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <h1 class="display-6 sectionTitle">Editar Módulo</h1>
                    <div class="mb-3">
                        <label for="title" class="form-label">Titulo:
                            <input type="text" id="title" name="title" class="form-control" value="{{ $module -> title }}">
                            <span id="error-message-title"></span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripcion:
                            <textarea id="description" name="description" class="form-control" rows="2" >{{ $module -> description }}</textarea>
                            <span id="error-message-description"></span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="teacher" class="form-label">Profesor:  </label>
                        <select id="teacher" class="form-select w-80 mx-auto" name="teacher">
                            <option value="0" selected disabled>-- Selecciona una opción --</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->teacherId }}" @if ($teacher->teacherId == $module->teacherId) selected @endif >{{$teacher->teacherId}}, {{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <span id="error-message-teacher"></span>
                    </div>
                    <input type="submit" class="btn btn-light" name="save" value="Agregar" id="submit-button" disabled>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/adminExceptions/adminModuleExceptions.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
</body>
</html>