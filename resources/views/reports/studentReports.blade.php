<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Reporte de Notas de Actividades Resueltas</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID Actividad</th>
                <th>Título</th>
                <th>Tipo de Pregunta</th>
                <th>Respuesta del Usuario</th>
                <th>Respuesta Correcta</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
                <tr>
                    <td>{{ $actividad -> activityId }}</td>
                    <td>{{ $actividad -> title }}</td>
                    <td>{{ $actividad -> question_type }}</td>
                    <td>{{ $actividad -> answer }}</td>
                    <td>{{ $actividad -> correct_answer }}</td>
                    @if($actividad->score === null)
                        <td>Sin calificación</td>
                    @else
                        <td>{{ $actividad -> score }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>