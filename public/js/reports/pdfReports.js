function confirmarReporte(element) {
    // Mostrar el cuadro de confirmación
    var confirmar = confirm("Se va a generar un pdf con los usuarios registrados en los ultimos 30 dias.\n\n¿Estás seguro de que deseas generar el reporte?");
    
    // Si el usuario hace clic en "Aceptar", permite la redirección
    if (confirmar) {
        return true; // Permite la redirección al href
    } else {
        // Si el usuario cancela, detiene la redirección
        return false; // Evita la redirección
    }
}