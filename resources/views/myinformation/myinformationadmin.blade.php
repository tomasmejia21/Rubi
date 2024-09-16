<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi información</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
@include('partials.rubiHeader')
    <br>
    <div class="container text-center text-white">
        <div class="row">
            <div class="col-4">
                @foreach ($admin as $admin)
                    @if(session('id') == $admin->adminId )
                        <h3>Datos usuario</h3>
                        <p>Id: {{ session('id') }}</p>
                        <p>Usuario: {{ $admin->adminUser }} </p>
                        <p>Nombre: {{ $admin->name }}</p>
                        <p>Correo: {{ $admin->email }}</p>
                        <a href="{{ route('admin.edit', $admin->adminId) }}" class="btn btn-outline-primary" role="button" aria-pressed="true">
                            Actualizar Datos
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="col-4">
                <h3>Blog</h3>
                <a href="/blog">Ver posts</a>
                <br>
                <a href="/blog/create">Gestionar posts</a>
            </div>
            <div class="col-4">
                <h3>Modulos</h3>
                <a href="/modules">Mis modulos</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/myinfoExceptions.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>