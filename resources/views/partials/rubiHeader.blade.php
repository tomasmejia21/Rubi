<header>
    <!-- adminHeader -->
    @if(session('role_id') == 1)
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="{{ asset('css/adminStyles/adminStyles.css') }}">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        </head>
        <body>
            <div class="container-fluid p-0 text-center">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-sm">
                            <div class="container-fluid">
                            <a class="navbar-brand" href="/inicio">
                                <img src="{{ asset('images/rubilogo.png')}}" alt="Rubí" id="rubilogo">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('inicio') ? 'active' : '' }}" href="/inicio">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('modules') ? 'active' : '' }}" href="/modules">Módulos</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-user-circle fa-3x" id="usericon"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" id="dropdown">
                                            <li>
                                                <div class="d-flex align-items-center" id="divphoto">
                                                    <i class="fas fa-user-circle fa-4x dropdown-item text-white"></i>
                                                    <ul class="ms-2" id="divphotoitems">
                                                        <li>{{ session('email') }}</li>
                                                        <li>Administrator</li>
                                                        <li>{{ session('username') }}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <br>
                                            <li><a class="dropdown-item" href="/myinformation/{{session('id')}}">Mi información</a></li>
                                            <li><a class="dropdown-item" href="/teachers">Administrar profesores</a></li>
                                            <li><a class="dropdown-item" href="/students">Administrar alumnos</a></li>
                                            <li><a class="dropdown-item" href="/educationalinstitutions">Administrar instituciones</a></li>
                                            <li><a class="dropdown-item" href="/activities">Administrar actividades</a></li>
                                            <li><a class="dropdown-item" href="/modules">Administrar módulos</a></li>
                                            <li><a class="dropdown-item" href="/blog">Ir al blog comunitario</a></li>
                                            <li><a class="dropdown-item" href="#">Descargar estadísticas generales</a></li>
                                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                                Salir
                                            </a></li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
    @elseif(session('role_id') == 2)
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="{{ asset('css/adminStyles/adminStyles.css') }}">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        </head>
        <body>
            <div class="container-fluid p-0 text-center">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-sm">
                            <div class="container-fluid">
                            <a class="navbar-brand" href="/inicio">
                                <img src="{{ asset('images/rubilogo.png')}}" alt="Rubí" id="rubilogo">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('inicio') ? 'active' : '' }}" href="/inicio">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('modules') ? 'active' : '' }}" href="/modules">Módulos</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-user-circle fa-3x" id="usericon"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" id="dropdown">
                                            <li>
                                                <div class="d-flex align-items-center" id="divphoto">
                                                    <i class="fas fa-user-circle fa-4x dropdown-item text-white"></i>
                                                    <ul class="ms-2" id="divphotoitems">
                                                        <li>{{ session('email') }}</li>
                                                        <li>Teacher</li>
                                                        <li>{{ session('username') }}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <br>
                                            <li><a class="dropdown-item" href="/myinformation/{{session('id')}}">Mi información</a></li>
                                            <li><a class="dropdown-item" href="/activities">Administrar mis actividades</a></li>
                                            <li><a class="dropdown-item" href="/modules">Administrar mis módulos</a></li>
                                            <li><a class="dropdown-item" href="/grades">Calificar mis alumnos</a></li>
                                            <li><a class="dropdown-item" href="/blog">Ir al blog comunitario</a></li>
                                            <li><a class="dropdown-item" href="#">Descargar estadísticas generales</a></li>
                                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                Salir
                                            </a></li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
    @elseif(session('role_id') == 3 || session('role_id') == 4)
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="{{ asset('css/adminStyles/adminStyles.css') }}">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        </head>
        <body>
            <div class="container-fluid p-0 text-center">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-sm">
                            <div class="container-fluid">
                            <a class="navbar-brand" href="/inicio">
                                <img src="{{ asset('images/rubilogo.png')}}" alt="Rubí" id="rubilogo">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('inicio') ? 'active' : '' }}" href="/inicio">Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('modules') ? 'active' : '' }}" href="/modules">Módulos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->is('moduleProgress') ? 'active' : '' }}" href="/moduleProgress">Mi progreso</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-user-circle fa-3x" id="usericon"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" id="dropdown">
                                            <li>
                                                <div class="d-flex align-items-center" id="divphoto">
                                                    <i class="fas fa-user-circle fa-4x dropdown-item text-white"></i>
                                                    <ul class="ms-2" id="divphotoitems">
                                                        <li>{{ session('email') }}</li>
                                                        @if (session('role_id') == 3)
                                                            <li>ILT</li>
                                                        @elseif (session('role_id') == 4)
                                                            <li>ILD</li>
                                                        @endif
                                                        <li>{{ session('username') }}</li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <br>
                                            <li><a class="dropdown-item" href="/myinformation/{{session('id')}}">Mi información</a></li>
                                            <li><a class="dropdown-item" href="/enrollModules">Inscribir módulos</a></li>
                                            <li><a class="dropdown-item" href="/blog">Ir al blog comunitario</a></li>
                                            <li><a class="dropdown-item" href="#">Descargar estadísticas generales</a></li>
                                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                Salir
                                            </a></li>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
    @endif
</header>   
</html> 