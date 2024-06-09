<?php

    /**
     * @var yii\web\View $this
     */

    use yii\bootstrap4\Modal;
    use yii\helpers\Url;

    // Título de la página
    $this->title = 'Inicio';

    // Registrar archivos JavaScript
    $this->registerJsFile('@web/js/lectorQr.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="site-index">
    <div class="container">

        <!-- Crear una fila con contenido centrado -->
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <h1>Escanear código QR</h1>
            </div>
            <div class="col-md-12 col-10 d-flex justify-content-center">
                <!-- Crear una columna para el lector de códigos QR -->
                <div id="reader" style="margin: 8px 0;"></div>
            </div>
        </div>

        <hr>

        <div class="row d-flex justify-content-center">
            <!-- Crear una columna centrada para el encabezado h3 -->
            <div class="col-12">
                <h2>Ingresar código del portátil</h2>
            </div>
            <!-- Crear una columna para el grupo de entrada -->
            <div class="col-7 col-xl-2 col-lg-3 col-md-3 col-sm-4" style="margin: 8px 0;">
                <!-- Crear un grupo de entrada -->
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="ej. 123A">
                    <div class="input-group-append">
                        <!-- Crear un botón para escanear el código QR o ingresar el código de portátil -->
                        <button class="btn btn-primary" id="buscarPortatil">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <title>Buscar portátil</title>
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

    // Modal para mostrar información del portátil
    Modal::begin([
        'title' => '<h2 class="col-12" id="tituloPortatil"></h2>',
        'id' => 'modalPortatil',
        'size' => 'modal-lg',
        'closeButton' => false
    ]);
        echo "<div id='contenidoPortatil'></div>";
    Modal::end();

    // Modal para mostrar información del cargador
    Modal::begin([
        'title' => '<h2 class="col-12" id="tituloCargador"></h2>',
        'id' => 'modalCargador',
        'closeButton' => false
    ]);
        echo "<div id='contenidoCargador'></div>";
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

    // Renderizar el escáner de códigos QR
    scanner.render(success, error);

    // Función para manejar un escaneo de código QR exitoso
    function success(result) {
        buscar(result);
        scanner.clear();
        document.getElementById('reader').remove();
    }

    // Función para manejar errores del escáner de códigos QR
    function error(err) {
        console.error(err);
    }

    // Manejar el evento de clic en el botón de búsqueda
    $('#buscarPortatil').click(function() {
        var busqueda = $('#searchInput').val();
        buscar(busqueda);
    });

    // Función para buscar el dispositivo basado en el código
    function buscar(resultado) {

        var recortarResultado = false;
        var patronPortatil, patronCargador;

        if (resultado.length !== 4) {
            patronPortatil = /^P\d{3}[A-Z]$/;
            patronCargador = /^C\d{3}[A-Z]$/;
            recortarResultado = true;
        } else {
            patronPortatil = /^\d{3}[a-zA-Z]$/;
            patronCargador = /^\d{3}[a-zA-Z]$/;
        }

        if (patronPortatil.test(resultado)) {
            mostrarModal('Portátil', resultado, recortarResultado, '#tituloPortatil', '#contenidoPortatil', '<?= Url::to(["site/portatil"]) ?>', '#modalPortatil');
        } else if (patronCargador.test(resultado)) {
            mostrarModal('Cargador', resultado, recortarResultado, '#tituloCargador', '#contenidoCargador', '<?= Url::to(["site/cargador"]) ?>', '#modalCargador');
        } else {
            alert('El código del dispositivo debe tener el formato correcto (ej. 123A)');
            location.reload();
        }

    }

    // Función para mostrar el modal
    function mostrarModal(tipo, resultado, recortar, tituloSelector, contenidoSelector, url, modalSelector) {

        var codigo = (recortar) ? resultado.substring(1) : resultado;
        document.querySelector(tituloSelector).innerText = tipo + ' ' + codigo.toUpperCase();

        $.get(url, {codigo: codigo}, function(data) {
            $(contenidoSelector).html(data);
            $(modalSelector).modal('show');
        });

        $(modalSelector).on('hidden.bs.modal', function () {
            location.reload();
        });

    }

</script>
