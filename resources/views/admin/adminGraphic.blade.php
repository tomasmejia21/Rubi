<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Usuarios Registrados</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/adminStyles/adminGraphicGenerationStyles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    @include('partials.rubiHeader')
    <h1 class="text-center mt-5">Gráfico de Usuarios Registrados por Mes</h1>
    <div class="row justify-content-center">
        <div id="user-registration-chart" class="col-md-8" data-monthly-data='@json($monthlyData)'></div>
    </div>
    <div class="text-center mt-5">
        <a href="{{ route('students.index') }}" id="submit-button" class="btn btn-light">Volver</a>
    </div>
    <br>
    <!-- <input type="hidden" id="monthlyData" value="@json($monthlyData)"> -->

    <!-- <script>
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
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/reports/GraphicGeneration.js')}}"></script>
</body>
</html>