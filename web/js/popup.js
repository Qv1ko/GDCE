$(document).ready(function() {
    $('#popup-button').click(function(e) {
        // Cancela el envio a la nueva página
        e.preventDefault();
        // Muestra el id myModal
        $('#myModal').modal('show');
    });
});
