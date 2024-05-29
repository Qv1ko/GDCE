$(document).ready(function() {
    // Controlador de eventos de clic al botón
    $('#botonCreate').click(mostrarModal);
});

// Función para mostrar el modal
function mostrarModal(e) {
    // Previene la acción del evento
    e.preventDefault();
    // Muestra el modal
    $('#modal').modal('show');
}
