<?php

    /**
     * @var yii\web\View $this
     */
    use yii\bootstrap4\Modal;
    use yii\helpers\Url;

    // Título de la página
    $this->title = 'Inicio';

    // Enlace al archivo lectorQr.js
    $this->registerJsFile('@web/js/lectorQr.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="site-index">

    <div class="container">

        <!-- Crear una fila con contenido centrado -->
        <div class="row d-flex justify-content-center">
        
            <div class="col-12">
                <h2>Escanea el código QR</h2>
            </div>
            
            <div class="col-md-12 col-10 d-flex justify-content-center">
                <!-- Crear una columna para el lector de códigos QR -->
                <div id="reader"></div>
            </div>

        </div>

        <hr>

        <div class="row d-flex justify-content-center">

            <!-- Crear una columna centrada para el encabezado h3 -->
            <div class="col-12">
                <h2>Ingresa el código del portátil</h2>
            </div>

            <!-- Crear una columna para el grupo de entrada -->
            <div class="col-md-2 col-sd-3 col-6">
                <!-- Crear un grupo de entrada -->
                <div class="input-group">

                    <input type="text" id="searchInput" class="form-control" placeholder="(ej. 123A)">

                    <div class="input-group-append">
                        <!-- Crear un botón para escanear el código QR o ingresar el código de portátil -->
                        <button class="btn btn-primary" id="buscarPortatil">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/>
                                <path d="M21 21l-6 -6"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
            
        </div>

    </div>
</div>

<?php

    Modal::begin([
        'title' => '<h2 class="col-12" id="tituloPortatil"></h2>',
        'id' => 'modal',
        'size' => 'modal-lg',
        'closeButton' => false
    ]);
    echo "<div id='contenido'></div>";
    Modal::end();

?>

<!-- Script de JavaScript para controlar el escaner y el buscador de códigos -->
<script>

    const scanner = new Html5QrcodeScanner('reader', {
        qrbox: {
            width: 240,
            height: 240,
        },
        fps: 20,
    });

    // Renderizar el escáner de código QR
    scanner.render(success, error);

    // Definir una función para manejar un escaneo de código QR exitoso
    function success(result) {

        // Llamar a la función buscar con el resultado del escaneo de código QR
        buscar(result);

        // Limpiar el escáner de código QR
        scanner.clear();

        // Remover el escáner de código QR de la página
        document.getElementById('reader').remove();

    }

    // Función para manejar errores del escáner de códigos QR
    function error(err) {
        console.error(err);
    }

    $('#buscarPortatil').click(function() {
        var codigo = $('#searchInput').val();
        buscar(codigo);
    });

    // Función para redirigir al usuario a la página del portátil
    function buscar(codigo) {

        // Expresión regular del código de los portátiles
        var patron = /^\d{3}[a-zA-Z]$/;

        // Verificar si el código de entrada coincide con la expresión regular
        if (patron.test(codigo)) {
            
            document.getElementById('tituloPortatil').innerText = 'Portátil ' + codigo.toUpperCase();

            $.get('<?= Url::to(["site/reserva"]) ?>', {portatil: codigo}, function(data) {
                $('#contenido').html(data);
                $('#modal').modal('show');
            });

            $('#modal').on('hidden.bs.modal', function () {
                location.reload();
            });

        } else {
            // Si el código no coincide, mostrar una alerta y recargar la página
            alert('El código del portátil debe tener el formato correcto (ej. 123A)');
            location.reload();
        }
        
    }

</script>
