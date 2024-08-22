@include('partials.rubiHeader')
    <br>
    <div class="container text-center text-white">
        <div class="row">
            <div class="col-4">
                @foreach ($teachers as $teacher)
                    @if(session('id') == $teacher->teacherId )
                        <h3>Datos usuario</h3>
                        <p>Id: {{ session('id') }}</p>
                        <p>Usuario: {{ $teacher->adminUser }} </p>
                        <p>Nombre: {{ $teacher->name }}</p>
                        <p>Correo: {{ $teacher->email }}</p>
                        <a href="{{ route('teacher.edit', $teacher->teacherId) }}" class="btn btn-outline-primary" role="button" aria-pressed="true">
                            Actualizar Datos
                        </a>
                    @endif
                @endforeach
            </div>
            <div class="col-4">
                <h3>Blogs</h3>
                <a href="">Entradas blog</a>
                <br>
                <a href="">Mensajes en foros</a>
                <br>
                <a href="">Foros de discusion</a>
            </div>
            <div class="col-4">
                <h3>Modulos</h3>
                <a href="">Mis modulos</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/myinfoExceptions.js')}}"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
</body>
</html>