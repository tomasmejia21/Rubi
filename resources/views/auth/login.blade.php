@extends('layouts.app')

@section('content')
@if (session('registered'))
    @if (session('username'))
        <div class="alert alert-success">
            Tu usuario es: {{ session('username') }} guardalo!!
        </div>
    @endif
@endif
<div class="container-fluid p-0 text-center">
    <br>
    <div class="row">
        <div class="col"></div>
        <div class="col-md-6">
            <div class="card" id="middleDiv">
                <div class="card-header" id="sectionTitle"><h1>Iniciar Sesión</h1></div>
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
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">Usuario</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span id="error-message-username"></span> 
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
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recordar credenciales
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-light" id="submit-button">
                            Acceder
                        </button>
                        <br>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
<script src="{{ asset('js/authExceptions/loginExceptions.js')}}"></script>
</body>
</html>
