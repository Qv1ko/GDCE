$('.botonAplicaciones').on('click', function() {
    var id = $(this).data('id');
    $.ajax({
        url: '/ruta/a/tu/controlador', // Actualiza esto con la ruta a tu controlador
        data: {id: id},
        success: function(data) {
            $('#modalAplicaciones .modal-body').html(data);
            $('#modalAplicaciones').modal('show');
        }
    });
});
