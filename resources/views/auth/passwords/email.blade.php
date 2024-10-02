@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 text-center">
    <br>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card" id="middleDiv">
                <div class="card-header" id="sectionTitle">Cambiar contraseña</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico
                                <input id="email" type="email" class="form-control" name="email">
                                <span id="error-message-email"></span>
                            </label>
                        </div>
                        <input type="submit" class="btn btn-light" name="save" value="Agregar" id="submit-button" disabled>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>
@endsection
<script src="{{ asset('js/authExceptions/forgotPasswordExceptions.js')}}"></script>  
</body>
</html>
