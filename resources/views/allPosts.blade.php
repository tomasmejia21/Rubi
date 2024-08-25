<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubí - Administrar alumnos</title>
    <link rel="stylesheet" href="{{ asset('css/blogStyles/Styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    
    <div class="container text-center">
        <p></p>
        <a class="btn btn-secondary" href="/blog/create" role="button">Gestionar posts</a>
        <p></p>
        <div class="row align-items-start">
            <div class="col">
                <table class="table table-borderless table-dark table-striped">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Date</th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <th scope="row">
                                @if($post -> image_url)
                                    <img src="storage/{{ $post -> image_url }}" alt="" style="width:400px;">
                                @else
                                    {{ $post -> id }}
                                @endif
                            </th>
                            <td>{{ $post -> title }}</td>
                            <td>{{ $post -> body }}</td>
                            <td>{{ $post -> created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>