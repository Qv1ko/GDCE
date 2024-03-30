<?php

    /** @var yii\web\View $this */
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\JsExpression;

    $this->title = 'Inicio';

    $this->registerJsFile('@web/js/lector_qr.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="site-index">

    <div class="row justify-content-center">
        <div id="reader" class="col-6"></div>
        <div id="result"></div>
        <div class="text-center col-12">
            <h3>Escanea el código QR <br> o <br> Ingresa el código del portátil</h3>
        </div>
        <div class="col-md-2 col-sd-3">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="(ej. 123A)">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="buscar(document.getElementById('searchInput').value)">
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

    <script>

        const scanner = new Html5QrcodeScanner('reader', { 
            qrbox: {
                width: 240,
                height: 240,
            },
            fps: 20,
        });


        scanner.render(success, error);

        function success(result) {

            buscar(result);
            
            scanner.clear();
            
            document.getElementById('reader').remove();

        }

        function error(err) {
            console.error(err);
        }

        function buscar(codigo) {

            var patron = /^\d{3}[a-zA-Z]$/;

            if (patron.test(codigo)) {
                window.location.href = 'site/portatil?portatil=' + codigo;
            } else {
                alert('El código del portátil debe tener el formato correcto (ej. 123A)');
                location.reload();
            }
            
        }
        
    </script>

</div>
