$(document).on('click', '#botonUpdate', function(e) {
    e.preventDefault();
    var title = $(this).data('code');
    $('#tituloModalUpdate').text(title);
    $('#modalUpdate').modal('show').find('.modal-body').load($(this).attr('href'));
});

$(document).on('submit', '#updateForm', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: 'post',
        data: $(this).serialize(),
        success: function(response) {
            if (!response.success) {
                $('#modalUpdate').modal('show').find('.modal-body').html(response);
            }
        }
    });
});
