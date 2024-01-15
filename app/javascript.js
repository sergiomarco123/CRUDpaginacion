//noo funciona
function eliminarDato(nombre) {
    // Mostrar una ventana de confirmación
    var confirmacion = confirm("¿Estás seguro de que deseas eliminar "+nombre+"?");

    // Verificar la respuesta del usuario
    if (confirmacion) {
        alert("Dato eliminado correctamente");
    } else {
        // El usuario ha hecho clic en "Cancelar" o ha cerrado la ventana de confirmación
        alert("Operación de eliminación cancelada");
    }
}