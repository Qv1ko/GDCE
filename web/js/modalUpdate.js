// Espera a que el documento esté completamente cargado
$(document).on('click', '#botonUpdate', function(e) {
    // Previene la acción predeterminada del evento
    e.preventDefault();
    // Establece como titulo el valor del data-code
    var title = $(this).data('code');
    $('#tituloModalUpdate').text(title);
    // Muestra el modal y carga el contenido
    $('#modalUpdate').modal('show').find('.modal-body').load($(this).attr('href'));
});

// Cuando se envía el formulario con el id 'updateForm'
$(document).on('submit', '#updateForm', function(e) {
    // Previene la acción predeterminada del evento
    e.preventDefault();
    // Realiza una solicitud AJAX al servidor
    $.ajax({
        // URL a la que se enviarán los datos
        url: $(this).attr('action'),
        type: 'post',
        // Datos del formulario serializados
        data: $(this).serialize(),
        // Función que se ejecutará si la solicitud tiene éxito
        success: function(response) {
            // Si la respuesta del servidor no fue exitosa muestra el modal
            if (!response.success) {
                $('#modalUpdate').modal('show').find('.modal-body').html(response);
            }
        }
    });
});
