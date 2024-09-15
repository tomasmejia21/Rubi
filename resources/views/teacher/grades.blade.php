<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones</title>
    <link rel="stylesheet" href="{{ asset('css/teacherStyles/gradesStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    <div class="container-fluid p-0 text-center">
        <div class="row">
            <div class="col">
                <h1 class="display-4 sectionTitle">Calificar alumnos</h1>
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
                    <th scope="col">Actividad</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userActivities as $userActivity)
                        <tr>
                            <td>{{ $userActivity->activityId }}</td>
                            <td>{{ $userActivity->userId }}</td>
                            <td>
                                <button type="button" class="btn btn-hover-crimson" data-toggle="modal" data-target="#gradeModal" onclick="openModal('{{ $userActivity->answer }}', '{{ $userActivity->userId }}', '{{ $userActivity->activityId }}')">
                                    <i class="bi bi-table text-white"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                <form id="gradeForm" method="POST" action="">
                    @csrf
                    <input type="hidden" id="userId" name="userId">
                    <input type="hidden" id="activityId" name="activityId">
                    <!-- The Modal -->
                    <div class="modal" id="gradeModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Calificar Respuesta</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="studentAnswer">Respuesta del estudiante:</label>
                                        <textarea type="text" id="studentAnswer" class="form-control" readonly></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="gradeInput">Calificación</label>
                                        <input type="number" id="gradeInput" name="grade" class="form-control" placeholder="Ingrese la calificación aquí..." step="any">
                                        <span id="error-message-grade"></span>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" id="gradeButton" disabled>Calificar</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/teacherExceptions/teacherGradeExceptions.js')}}"></script>
    <script src="{{ asset('js/functionality/gradeFunctionality.js')}}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>