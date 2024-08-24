    @include('partials.rubiHeader')
    <title>Inicio</title>
    <br>
    <div class="container text-center text-white">
        <div class="row">
          <div class="col"></div>
          <div class="col-6">
            <h1>Tutorial</h1>
            <div class="embed-responsive embed-responsive-16by9" style="max-width: 500px; margin: auto;">
                <video class="embed-responsive-item" id="video" src="{{ asset('videos/tutorial.mp4') }}" controls></video>
            </div>
            <br>
            <p>Ahora que ya sabes usar la página, puedes ir a los módulos y empezar con el que más te interese!</p>
            <a href="/modulos" class="btn btn-light" id="button">Ir a módulos</a>
          </div>
          <div class="col"></div>
        </div>
    </div>



    <script src="{{ asset('js/excepionts.js')}}"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
</body>
</html>