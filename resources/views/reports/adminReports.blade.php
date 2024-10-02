<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Estudiantes Registrados En Los Últimos 30 Dias</h1>
    <div>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Institución Educativa</th>
                <th>Fecha Registro</th>
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
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
</body>
</html>