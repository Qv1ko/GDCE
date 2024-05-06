<?php

    /** @var yii\web\View $this */
    use kartik\select2\Select2;

?>

<div class="d-flex flex-row justify-content-around align-items-center">

    <div class="col-4 d-flex flex-column align-items-center" style="margin: 16px 0;">
        <?php if ($estado === "Disponible") : ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#00F377" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-check">
                <title>Estado del dispositivo</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                <path d="M9 12l2 2l4 -4" />
            </svg>
        <?php elseif ($estado === "No disponible") : ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FF0033" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-x">
                <title>Estado del dispositivo</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                <path d="M9 9l6 6m0 -6l-6 6" />
            </svg>
        <?php elseif ($estado === "Averiado") : ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FFD000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-square">
                <title>Estado del dispositivo</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                <path d="M12 8v4" />
                <path d="M12 16h.01" />
            </svg>
        <?php endif; ?>
        <p style="margin-top: 8px"><?= $estado ?></p>
    </div>

    <div class="col-4 d-flex flex-column align-items-center" style="margin: 16px 0;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 21v-13l9 -4l9 4v13" />
            <path d="M13 13h4v8h-10v-6h6" />
            <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
        </svg>
        <p style="margin-top: 8px">Aula <?= $almacen ?></p>
    </div>

    <div class="col-4 d-flex flex-column align-items-center" style="margin: 16px 0;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-battery-charging">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M16 7h1a2 2 0 0 1 2 2v.5a.5 .5 0 0 0 .5 .5a.5 .5 0 0 1 .5 .5v3a.5 .5 0 0 1 -.5 .5a.5 .5 0 0 0 -.5 .5v.5a2 2 0 0 1 -2 2h-2" />
            <path d="M8 7h-2a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h1" />
            <path d="M12 8l-2 4h3l-2 4" />
        </svg>
        <p style="margin-top: 8px">Cargador <?= $cargador ?></p>
    </div>

</div>

<div class="d-flex flex-column justify-content-center align-items-center">

    <div class="col-10 d-flex flex-row justify-content-start align-items-center" style="margin: 16px 0;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sunrise">
            <title>Alumno de mañana</title>
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
            <path d="M3 21l18 0" />
            <path d="M12 9v-6l3 3m-6 0l3 -3" />
        </svg>
        <p style="margin-left: 8px">Alumno de mañana: <?= $alumnoManana ?></p>
    </div>

    <div class="col-10 d-flex flex-row justify-content-start align-items-center" style="margin: 16px 0;">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sunset">
            <title>Alumno de tarde</title>
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
            <path d="M3 21l18 0" />
            <path d="M12 3v6l3 -3m-6 0l3 3" />
        </svg>
        <p style="margin-left: 8px">Alumno de tarde: <?= $alumnoTarde ?></p>
        <!-- <# Select2::widget([
            'model' => $model,
            'attribute' => 'state_2',
            'data' => $data,
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?> -->
    </div>

</div>

<div class="d-flex flex-row justify-content-around align-items-center" style="margin: 16px 0;">
    <button type="button" class="btn btn-primary" id="guardarBtn">
        Guardar
    </button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
        Cancelar
    </button>
</div>
