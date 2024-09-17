<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Usuarios Registrados</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <h1>Gráfico de Usuarios Registrados por Mes</h1>
    <div id="user-registration-chart"></div>
    <a href="{{ route('students.index') }}" class="btn btn-primary">Volver</a>

    <script>
        // Datos de usuarios por mes (estos vienen desde el controlador)
        var monthlyData = @json($monthlyData);

        // Etiquetas para los meses
        var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

        // Configuración del gráfico
        var data = [{
            x: months,
            y: Object.values(monthlyData),
            type: 'bar'
        }];

        var layout = {
            title: 'Usuarios Registrados por Mes',
            xaxis: {
                title: 'Meses'
            },
            yaxis: {
                title: 'Cantidad de Usuarios'
            }
        };

        // Renderiza el gráfico
        Plotly.newPlot('user-registration-chart', data, layout);
    </script>
</body>
</html>