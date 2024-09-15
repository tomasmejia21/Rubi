function confirmDelete() {
    var result = confirm("Seguro que desea borrar el módulo? Se borrarán todas las actividades y progresos asociados a este");
    if (result) {
        // Si el usuario hace clic en "OK", permite que se envíe el formulario
        return true;
    } else {
        // Si el usuario hace clic en "Cancelar", evita que se envíe el formulario
        return false;
    }
}