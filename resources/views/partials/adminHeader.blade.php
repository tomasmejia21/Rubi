<header>
    <div class="container-fluid p-0 text-center">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-sm">
                    <div class="container-fluid">
                      <a class="navbar-brand" href="#">
                        <img src="{{ asset('images/rubilogo.png')}}" alt="Rubí" id="rubilogo">
                      </a>
                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Módulos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Mi progreso</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Configuración</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle fa-3x"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Mi información</a></li>
                                    <li><a class="dropdown-item" href="/teachers">Administrar profesores</a></li>
                                    <li><a class="dropdown-item" href="/students">Administrar alumnos</a></li>
                                    <li><a class="dropdown-item" href="/educationalinstitutions">Administrar instituciones</a></li>
                                    <li><a class="dropdown-item" href="#">Administrar actividades</a></li>
                                    <li><a class="dropdown-item" href="#">Administrar modulos</a></li>
                                    <li><a class="dropdown-item" href="#">Ir al foro comunitario</a></li>
                                    <li><a class="dropdown-item" href="#">Descargar estadísticas generales</a></li>
                                    <li><a class="dropdown-item" href="#">Salir</a></li>
                                </ul>
                            </li>
                        </ul>
                      </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>   
</html> 