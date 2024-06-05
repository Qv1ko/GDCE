<?php

    /**
     * @var yii\web\View $this
     */
    use yii\bootstrap4\Modal;
    use yii\helpers\Url;

    // Título de la página
    $this->title = 'Inicio';

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
                <div id="reader"></div>
            </div>

        </div>

        <hr>

        <div class="row d-flex justify-content-center">

            <!-- Crear una columna centrada para el encabezado h3 -->
            <div class="col-12">
                <h2>Ingresar código del portátil</h2>
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

    Modal::begin([
        'title' => '<h2 class="col-12" id="tituloPortatil"></h2>',
        'id' => 'modalPortatil',
        'size' => 'modal-lg',
        'closeButton' => false
    ]);
    echo "<div id='contenidoPortatil'></div>";
    Modal::end();

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
        var busqueda = $('#searchInput').val();
        buscar(busqueda);
    });

    // Función para redirigir al usuario a la página del portátil
    function buscar(resultado) {

        var recortarResultado = false;

        if (resultado.length !== 4) {
            var patronPortatil = /^P\d{3}[A-Z]$/;
            var patronCargador = /^C\d{3}[A-Z]$/;
            recortarResultado = true;
        } else {        
            var patronPortatil = /^\d{3}[a-zA-Z]$/;
            var patronCargador = /^\d{3}[a-zA-Z]$/;
        }

        // Verificar si el código de entrada coincide con la expresión regular
        if (patronPortatil.test(resultado)) {

            codigo = (recortarResultado) ? resultado.substring(1) : resultado;

            document.getElementById('tituloPortatil').innerText = 'Portátil ' + codigo.toUpperCase();

            $.get('<?= Url::to(["site/portatil"]) ?>', {codigo: codigo}, function(data) {
                $('#contenidoPortatil').html(data);
                $('#modalPortatil').modal('show');
            });

            $('#modalPortatil').on('hidden.bs.modal', function () {
                location.reload();
            });

        } else if (patronCargador.test(resultado)) {

            codigo = (recortarResultado) ? resultado.substring(1) : resultado;

            document.getElementById('tituloCargador').innerText = 'Cargador ' + codigo.toUpperCase();

            $.get('<?= Url::to(["site/cargador"]) ?>', {codigo: codigo}, function(data) {
                $('#contenidoCargador').html(data);
                $('#modalCargador').modal('show');
            });

            $('#modalCargador').on('hidden.bs.modal', function () {
                location.reload();
            });

        } else {
            // Si el código no coincide, mostrar una alerta y recargar la página
            alert('El código del dispositivo debe tener el formato correcto (ej. 123A)');
            location.reload();
        }
        
    }

</script>
