<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubí - Administrar profesores</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    @include('partials.adminHeader')
    <!-- Hasta aquí llega el header -->
    <div class="container-fluid p-0 text-center">
        <br>
        <div class="row">
            <div class="col"></div>
            <div class="col" id="middleDiv">
                <form action="{{route('teachers.store')}}" method="POST">
                    @csrf
                    <h1 class="display-6 sectionTitle">Agregar profesor</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:
                            <input type="text" id="name" name="name" class="form-control">
                            <span id="error-message-name"></span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo:
                            <input type="email" id="email" name="email" class="form-control" placeholder="example@gmail.com">
                            <span id="error-message-email"></span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:
                            <input type="password" id="password" name="password" class="form-control" placeholder="Temporal">
                            <span id="error-message-password"></span>
                        </label>
                    </div>
                    <input type="submit" class="btn btn-light" name="save" value="Agregar" id="submit-button">
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="{{ asset('js/script.js')}}"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
</body>
</html>