<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progreso</title>
    <link rel="stylesheet" href="{{ asset('css/viewProgressStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    
    <div class="container text-center">
        <div class="my-5">
            @if (session('role_id')==1 || session('role_id')==2)
                <a href="{{ route('modules.create') }}" class="btn btn-light">Crear módulo</a>
            @endif
            <div class="mt-4">
                <div id="modulesContainer">
                    <!-- Iterar sobre los módulos obtenidos de la base de datos -->
                    @foreach($modules as $module)
                    <div class="module-row">
                        <!-- Círculo de progreso del módulo -->
                        <div class="module-progress" 
                            style="background: conic-gradient(from 0.25turn, crimson {{ $moduleProgress->firstWhere('moduleId', $module->moduleId)->progress ?? 0; }}%, white {{ $moduleProgress->firstWhere('moduleId', $module->moduleId)->progress ?? 0; }}%);">
                            <a href="{{ route('modules.show', $module->moduleId) }}" class="module-circle">
                                {{ $module->title }}
                                <br>
                                {{ $moduleProgress->firstWhere('moduleId', $module->moduleId)->progress ?? 0; }}%
                            </a>
                        </div>
                        
                        <!-- Información del módulo -->
                        <div class="module-info">
                            <!-- Barra de progreso -->
                            <div class="progress" id="progress-bar">
                                <div class="progress-bar" role="progressbar" style="width: {{ $moduleProgress->firstWhere('moduleId', $module->moduleId)->progress }}%; background-color: crimson;" aria-valuenow="{{ $moduleProgress->firstWhere('moduleId', $module->moduleId)->progress }}" aria-valuemin="0" aria-valuemax="100"></div>                
                            </div>
                            <br><br>
                            <h4 class="sectionTitle">Actividades ganadas: {{ $module->activitiesCount }} / {{ $module->totalActivitiesCount }}</h4>
                            <br>
                            <h4 class="sectionTitle">Calificación: {{ $module->averageScore }}</h4>
                        </div>
                    </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="sectionTitle">Progreso general de los módulos</h2>
        <div class="progress" id="progress-bar">
            <div class="progress-bar" role="progressbar" style="width: {{ $generalProgress }}%; background-color: crimson;" aria-valuenow="{{ $generalProgress }}" aria-valuemin="0" aria-valuemax="100"></div>                
        </div>
        <br>
        <h4 class="sectionTitle">Actividades ganadas: {{ $resolvedActivitiesCount }} / {{ $totalActivitiesCount }}</h4>
        <br>
        <h4 class="sectionTitle">Calificación: {{ $averageScore }}</h4>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>