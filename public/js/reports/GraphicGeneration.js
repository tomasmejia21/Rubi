// Etiquetas para los meses
var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

var chartElement = document.getElementById('user-registration-chart');

// Obtén los datos desde el atributo data-monthly-data en el HTML
var monthlyData = JSON.parse(chartElement.getAttribute('data-monthly-data'));

// Configuración del gráfico
var data = [{
    x: months,
    y: Object.values(monthlyData),
    type: 'bar',
    marker: {
        color: 'crimson'  // 220, 20, 60
    }
}];

var layout = {
    // title: 'Usuarios Registrados por Mes',
    // font: {
    //     color: 'white'
    // },
    xaxis: {
        title: {
            text: 'Meses',
            font: {
                color: 'white'
            }
        },
        tickfont: {
            color: 'white'
        }
    },
    yaxis: {
        title: {
            text: 'Cantidad de Usuarios',
            font: {
                color: 'white'  // Cambiar el color del título del eje Y a blanco
            }
        },
        tickfont: {
            color: 'white'  // Cambiar el color de las etiquetas de los números en el eje Y a blanco
        }
    },
    paper_bgcolor: '#121526',
    plot_bgcolor: '#121526'
};

// Renderiza el gráfico
Plotly.newPlot('user-registration-chart', data, layout);
