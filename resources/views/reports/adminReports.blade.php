<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Institución Educativa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $user)
            <tr>
                <td>{{ $user->userId }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->educationalinstitution->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
</body>
</html>