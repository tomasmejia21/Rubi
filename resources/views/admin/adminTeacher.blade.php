<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubí - Administrar profesores</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.adminHeader')
    <!-- Hasta aquí llega el header -->
    <div class="container-fluid p-0 text-center">
        <div class="row">
            <div class="col">
                <h1 class="display-4 sectionTitle">Administrar profesores</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">

            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-dark table-striped">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teachers as $profesor)
                        <tr>
                            <td>{{ $profesor->teacherId }}</td>
                            <td>{{ $profesor->teacherUser }}</td>
                            <td>{{ $profesor->name }}</td>
                            <td>{{ $profesor->email }}</td>
                            <td>
                                <a href="{{ route('teachers.edit', $profesor->teacherId) }}" class="btn btn-hover-crimson">
                                    <i class="bi bi-pencil-fill text-white"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $profesor->teacherId) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-hover-crimson">
                                        <i class="bi bi-trash-fill text-white"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="no-style">
                        <td class="no-style"></td>
                        <td class="no-style"></td>
                        <td class="no-style"></td>
                        <td class="no-style"></td>
                        <td class="no-style">
                            <a href="{{ route('teachers.create')}}" class="btn btn-success btn-light btn-lg" id="agregar">
                                <i class="fas fa-plus"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>