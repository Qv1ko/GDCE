<?php

    /**
     * @var yii\web\View $this
     */
    // use yii\bootstrap\Modal;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\JsExpression;
    use yii\bootstrap\Modal;
    use yii\helpers\Url;

    // Título de la página
    $this->title = 'Inicio';
    $id = "400E";

    // Enlace al archivo lector_qr.js
    $this->registerJsFile('@web/js/lector_qr.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);
    // $this->registerJsFile('@web/assets/jquery/jquery.min.js', ['position' => \yii\web\View::POS_HEAD]);

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

<div class="container">
    <div class="modal fade" id="modalPortatil" tabindex="-1" role="dialog" aria-labelledby="modalPortatilLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Portatil 003D</h2>
                    <!-- Botón cerrar -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script de JavaScript para controlar el escaner y el buscador de códigos -->
<script>

    // Crear un nuevo escáner de código QR HTML5
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
            // window.location.href = 'site/portatil?portatil=' + codigo;
            $('#modalPortatil').modal('show');

            // Cargar el contenido de portatil.php en el modal
            $.ajax({
                url: 'portatil?codigo=' + codigo,
                type: 'GET',
                success: function(data) {
                    $('.modal-body').html(data);
                }
            });
        } else {
            // Si el código no coincide, mostrar una alerta y recargar la página
            alert('El código del portátil debe tener el formato correcto (ej. 123A)');
            location.reload();
        }
    }


</script>
