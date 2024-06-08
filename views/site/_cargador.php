<?php

    /** @var yii\web\View $this */

use app\models\Portatiles;
use yii\helpers\Html;
    use yii\helpers\Url;

    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="container">

    <div class="d-flex flex-row justify-content-around align-items-center">

        <div class="col-4 d-flex flex-column align-items-center text-center" style="margin: 16px 0;">
            <?php if ($estado === "Disponible") : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-check">
                    <title>Estado del dispositivo</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    <path d="M9 12l2 2l4 -4" />
                </svg>
            <?php elseif ($estado === "No disponible") : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-x">
                    <title>Estado del dispositivo</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                    <path d="M9 9l6 6m0 -6l-6 6" />
                </svg>
            <?php elseif ($estado === "Averiado") : ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-square">
                    <title>Estado del dispositivo</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                    <path d="M12 8v4" />
                    <path d="M12 16h.01" />
                </svg>
            <?php endif; ?>
            <p style="margin-top: 8px"><?= $estado ?></p>
        </div>

        <div class="col-4 d-flex flex-column align-items-center text-center" style="margin: 16px 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                <title>Almacén</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 21v-13l9 -4l9 4v13" />
                <path d="M13 13h4v8h-10v-6h6" />
                <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
            </svg>
            <?php if ($almacen) : ?>
                <p style="margin-top: 8px;">Aula <?= $almacen ?></p>
            <?php else : ?>
                <p style="margin-top: 8px;">Sin almacén</p>
            <?php endif; ?>
        </div>    
    </div>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <?php if ($cargador->estado === 'Disponible'): ?>
            <div class="col-lg-8 d-flex flex-row justify-content-start align-items-center text-center" style="margin: 16px 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-laptop" style="margin-right: 8px;">
                    <title>Portátil</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 19l18 0" />
                    <path d="M5 6m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" />
                </svg>

                <?= Html::dropDownList('portatilSeleccionado', null, Portatiles::getListaPortatilesSinCargador(), ['prompt' => 'Selecciona un portátil', 'class' => 'form-control', 'id' => 'portatilSeleccionado']); ?>

            </div>
        <?php elseif ($cargador->estado === 'No disponible'): ?>
            <div class="col-lg-8 d-flex flex-row justify-content-center align-items-center" style="margin: 16px 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-laptop">
                    <title>Portátil</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 19l18 0" />
                    <path d="M5 6m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z" />
                </svg>
                <p style="margin-left: 8px">Portátil <?= $portatil->codigo ?></p>
            </div>
        <?php else : ?>
            <h3 style="margin: 24px 0;">El cargador no se puede vincular porque esta averiado</h3>
        <?php endif; ?>
    </div>

    <div class="row d-flex justify-content-around">
        <?= Html::button('<div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus" style="margin-right: 4px;">
                <title>Guardar</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 12h6" />
                <path d="M12 9v6" />
                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
            </svg>
            <span>Guardar</span>
        </div>', ['class' => 'btn btn-success', 'id' => 'guardarBtn']) ?>
        <?= Html::button('<div class="d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-x" style="margin-right: 4px;">
                <title>Cancelar</title>    
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                <path d="M9 9l6 6m0 -6l-6 6" />
            </svg>
            <span>Cancelar</span>
        </div>', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal', 'aria-label' => 'Close']) ?>
    </div>

</div>

<script>
    $("#guardarBtn").click(function() {

        var portatil = document.getElementById('portatilSeleccionado').value;

        $.ajax({
            url: '<?= Url::to(['cargan/vincular']) ?>',
            type: "POST",
            data: {
                cargador: <?= $cargador->id_cargador ?>,
                portatil: portatil,
            },
            success: function(response) {
                location.href = '<?= Url::to(['index']) ?>';
            },
            error: function(xhr, status, error) {
                <?= Yii::$app->session->setFlash('error', 'Ha ocurrido un error al intentar vincular el cargador'); ?>
            }
        });
        
    });
</script>
