<?php

    /** @var yii\web\View $this */
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\web\JsExpression;

    $this->title = 'Inicio';

?>

<div class="site-index">

    <script src="https://cdn.rawgit.com/mebjas/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <div id="reader" style="width:300px;height:300px"></div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // maneja el resultado del escaneo
            console.log(`QR code with decodedText=${decodedText}`, decodedResult);
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, qrbox: { width: 250, height: 250 } });
        html5QrcodeScanner.render(onScanSuccess);
    </script>

    <div class="row">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Ingresa el código del portátil (ej. 123A)">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="search()">Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function search() {
            var inputText = document.getElementById('searchInput').value;
            // Expresión regular para validar el patrón
            var regex = /^\d{3}[a-zA-Z]$/;
            if (regex.test(inputText)) {
                window.location.href = 'site/portatil?portatil=' + inputText;
            } else {
                alert("El código del portátil debe tener el formato correcto (ej. 123A)");
            }
        }
    </script>


</div>
