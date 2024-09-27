<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubi - Administrar Posts</title>
    <link rel="stylesheet" href="{{ asset('css/blogStyles/Styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    @include('partials.rubiHeader')
    <!-- Hasta aquí llega el header -->
    <div class="container my-5">
        <div class="row align-items-start">
            <!-- <div class="col-2"></div> -->
            <div class="col-12">
                <a href="/blog" id="submit-button" class="btn btn-secondary">Volver al blog</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Nuevo post
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Post</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>*Rellena todos los campos para crear un nuevo post*</p>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titulo</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                        <span id="error-message-title"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="body" class="form-label">Body</label>
                                        <textarea id="body" name="body" class="form-control" rows="3"></textarea>
                                        <span id="error-message-body"></span>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Imagen</label>
                                        <input class="form-control" type="file" id="image" name="image">
                                        <span id="error-message-image"></span>
                                    </div>
                                    
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Volver</button>
                                    <button type="submit" class="btn" id="submit-button" disabled>Crear</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <p></p>
                <table class="table table-borderless table-dark table-striped">
                    <thead>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <th scope="row">
                                @if($post -> image_url)
                                    <img src="{{ asset('storage/' . $post->image_url) }}" alt="Imagen descriptiva" style="width:200px;">
                                @else
                                    {{ $post -> id }}
                                @endif
                            </th>
                            <td>{{ $post -> title }}</td>
                            <td>{{ $post -> body }}</td>
                            <td>{{ $post -> created_at }}</td>
                            <td>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-hover-crimson">
                                        <i class="bi bi-trash-fill text-white"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- <div class="col-2"></div> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminExceptions/adminPostsExceptions.js')}}"></script>
</body>
</html>