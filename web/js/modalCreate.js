(function() {

    // Espera a que el documento esté completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        // Controlador de eventos de clic para el botón
        document.getElementById('botonCreate').addEventListener('click', mostrarModal);
    });

    // Función para mostrar el modal
    function mostrarModal(e) {
        // Previene la acción predeterminada del evento
        e.preventDefault();
        // Muestra el modal
        var modal = new bootstrap.Modal(document.getElementById('modal'));
        modal.show();
    }

})();
