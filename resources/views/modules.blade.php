<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulos</title>
    <link rel="stylesheet" href="{{ asset('css/adminStyles/adminModulesStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    <div class="container my-5">
        @if (session('role_id')==1 || session('role_id')==2)
            <a href="{{ route('modules.create') }}" class="btn btn-light">Crear módulo</a>
        @endif
        <div class="mt-4">
            <div id="modulesContainer" class="d-flex flex-wrap">
                <!-- Iterar sobre los módulos obtenidos de la base de datos -->
                @foreach($modules as $module)
                <div class="module-container">
                    <!-- En este caso tocó usar el style adentro de module-progress porque no se podía en el CSS por el conic-gradient -->
                    <div class="module-progress" 
                        style="background: conic-gradient(from 0.25turn, crimson {{ $progresses[$module->moduleId] ?? 0 }}%, white {{ $progresses[$module->moduleId] ?? 0  }}%);">
                        <a href="{{ route('modules.show', $module->moduleId) }}" class="module-circle">
                            {{ $module->title }}
                            <br>
                            {{ $progresses[$module->moduleId] ?? 0 }}%
                        </a>
                    </div>
                    @if ($module->status==False)
                        <div class="module-status">
                            Módulo desactivado
                        </div>
                    @endif
                    <div class="module-description">
                        {{ $module->description }}
                    </div>
                    <div>
                        @if(session('role_id')==1 || session('role_id')==2)
                            @if($module->status)
                                <a href="{{ route('modules.edit', $module->moduleId) }}" class="btn btn-hover-crimson">
                                    <i class="bi bi-pencil-fill text-white"></i>
                                </a>
                                <form onsubmit="return confirmDelete()" action="{{ route('modules.destroy', $module->moduleId) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-hover-crimson">
                                        <i class="bi bi-trash-fill text-white"></i>
                                    </button>
                                </form>
                            @else
                                <form onsubmit="return confirmActivate()" action="{{ route('modules.activate', $module->moduleId) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-hover-crimson">
                                        <i class="bi bi-check-lg text-white"></i>
                                    </button>
                                </form>
                            @endif
                            <br>
                            @if(session('role_id')==1)
                                <a href="{{ route('teachers.pdf', $module->moduleId) }}" class="btn btn-hover-crimson disabled-link" onclick="return confirmarReporteTeacher(this);" disabled>
                                    <i class="bi bi-file-earmark-text text-grey"></i>
                                </a>
                            @elseif(session('role_id')==2)
                                <a href="{{ route('teachers.pdf', $module->moduleId) }}" class="btn btn-hover-crimson" onclick="return confirmarReporteTeacher(this);">
                                    <i class="bi bi-file-earmark-text text-white"></i>
                                </a>
                            @endif
                            
                        @else
                            <br>
                            <form action="{{ route('modules.unsubscribe', ['module' => $module->moduleId, 'userId' => session('id')]) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro que desea salirse del módulo {{ $module->title }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light" id="submit-button">
                                    Salirse del módulo
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
    <script src="{{ asset('js/functionality/moduleButtonsFunctionality.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/reports/pdfReports.js')}}"></script>
</body>
</html>