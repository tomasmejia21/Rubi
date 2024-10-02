<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubí - Administrar profesores</title>
    <link rel="stylesheet" href="{{ asset('css/adminStyles/adminInstitutionsStyles.css') }}">
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
                <form action="{{route('EducationalInstitution.update',$institution->institutionalId)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <h1 class="display-6 sectionTitle">Modificar institucion educativa</h1>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre:
                            <input type="text" id="name" name="name" class="form-control" value="{{$institution->name}}">
                            <span id="error-message-name"></span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Direccion:
                            <input type="address" id="address" name="address" class="form-control" value="{{$institution->address}}">
                            <span id="error-message-address"></span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ciudad:
                            <input type="text" id="city" name="city" class="form-control" value="{{$institution->city}}">
                            <span id="error-message-city"></span>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Pais:
                            <input type="text" id="country" name="country" class="form-control" value="{{$institution->country}}">
                            <span id="error-message-country"></span>
                        </label>
                    </div>
                    <input type="submit" class="btn btn-light" name="save" value="Modificar" id="submit-button" disabled>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script src="{{ asset('js/adminExceptions/adminInstitutionalExceptions.js')}}"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
</body>
</html>