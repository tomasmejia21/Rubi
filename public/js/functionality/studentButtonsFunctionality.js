function confirmDelete() {
    var result = confirm("Seguro que desea desactivar el estudiante?");
    if (result) {
        // Si el usuario hace clic en "OK", permite que se envíe el formulario
        return true;
    } else {
        // Si el usuario hace clic en "Cancelar", evita que se envíe el formulario
        return false;
    }
}

function confirmActivate() {
    var result = confirm("Seguro que desea activar el estudiante?");
    if (result) {
        // Si el usuario hace clic en "OK", permite que se envíe el formulario
        return true;
    } else {
        // Si el usuario hace clic en "Cancelar", evita que se envíe el formulario
        return false;
    }
}