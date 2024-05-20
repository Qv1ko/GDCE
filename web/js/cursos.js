$(document).on('click', '.editarCursoBoton', function(e) {
    e.preventDefault();
    var title = $(this).data('code');
    $('#modalEditarCurso .tituloModalEditarCurso').text(title);
    $('#modalEditarCurso').modal('show').find('.modal-body').load($(this).attr('href'));
});
$(document).ready(function() {
    $('#crearCursoBoton').click(function(e) {
        e.preventDefault();
        $('#modalCrearCurso').modal('show');
    });
});

$(document).on('submit', '#cursos-form', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: 'post',
        data: $(this).serialize(),
        success: function(response) {
            if (!response.success) {
                $('#modalEditarCurso').modal('show').find('.modal-body').html(response);
                $('#modalCrearCurso').modal('show');
            }
        }
    });
});
