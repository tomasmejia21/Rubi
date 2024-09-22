@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 text-center">
    <br>
    <div class="row">
        <div class="col"></div>
        <div class="col-md-6">
            <div class="card" id="middleDiv">
                <div class="card-header" id="sectionTitle"><h1>Registrarse</h1></div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Authentication Links -->
                @guest
                    <div class="d-flex justify-content-center">
                        @if (Route::has('login'))
                            <a class="btn auth-button {{ Route::is('login') ? 'active' : '' }}" href="{{ route('login') }}">Iniciar Sesión</a>
                        @endif

                        @if (Route::has('register'))
                            <a class="btn auth-button {{ Route::is('register') ? 'active' : '' }}" href="{{ route('register') }}">Registrarse</a>
                        @endif
                    </div>
                @endguest
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name">
                                <span id="error-message-name"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="institution" class="col-md-4 col-form-label text-md-end">Institución educativa</label>

                            <div class="col-md-6">
                                <select id="institution" class="form-control" name="institution">
                                    <option value="0" selected disabled>-- Selecciona una opción --</option>
                                    @foreach ($educational_institutions as $institution)
                                        <option value="{{ $institution->institutionalId }}">{{ $institution->name }}</option>
                                    @endforeach
                                </select>
                                <span id="error-message-institution"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role_id" class="col-md-4 col-form-label text-md-end">Rol</label>
                        
                            <div class="col-md-6">
                                <select id="role_id" class="form-control" name="role_id">
                                    <option value="0" selected disabled>-- Selecciona una opción --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <span id="error-message-role"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email">
                                <span id="error-message-email"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                                <span id="error-message-password"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirmar contraseña</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                                <span id="error-message-confirmpassword"></span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4 d-flex justify-content-center  ">
                                <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}" data-theme="dark"></div>
                                @if(Session::has('g-recaptcha-response'))
                                <p class="alert {{ session::get('alert-class', 'alert-info') }}">
                                    {{ Session::get('g-recaptcha-response') }}
                                </p>
                                @endif
                                <br>
                            </div>
                        </div>

                        <button type="submit" name="save" class="btn btn-light" id="submit-button" disabled>
                            Registrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/authExceptions/registerExceptions.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- reCaptcha script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>
