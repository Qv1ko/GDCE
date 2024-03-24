<?php

    /** @var yii\web\View $this */
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $this->title = 'Portátil ' . $codigo;

?>

<div class="site-index">
    <h1 class="col-12"><?= 'PORTÁTIL ' . strtoupper($codigo) ?></h1>
    <div class="d-flex flex-row justify-content-around align-items-center">
        <div class="caja d-flex flex-row align-items-center">
            <?php if ($estado === "Disponible"): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00F377" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                    <path d="M9 12l2 2l4 -4" />
                </svg>
            <?php elseif ($estado === "No disponible"): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FF0033" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-x">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                    <path d="M9 9l6 6m0 -6l-6 6" />
                </svg>
            <?php elseif ($estado === "Averiado"): ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFD000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-square">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                    <path d="M12 8v4" />
                    <path d="M12 16h.01" />
                </svg>
            <?php endif; ?> 
            <p style="color: #4040FF"><?= strtoupper($estado) ?></p>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-around align-items-center">
        <div class="caja d-flex flex-row align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-battery-charging">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M16 7h1a2 2 0 0 1 2 2v.5a.5 .5 0 0 0 .5 .5a.5 .5 0 0 1 .5 .5v3a.5 .5 0 0 1 -.5 .5a.5 .5 0 0 0 -.5 .5v.5a2 2 0 0 1 -2 2h-2" />
                <path d="M8 7h-2a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h1" />
                <path d="M12 8l-2 4h3l-2 4" />
            </svg>
            <p>Cargador <?= $cargador ?></p>
        </div>
        <div class="caja d-flex flex-row align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 21v-13l9 -4l9 4v13" />
                <path d="M13 13h4v8h-10v-6h6" />
                <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
            </svg>
            <p>Aula <?= $almacen ?></p>
        </div>        
    </div>
    <div class="caja d-flex flex-row justify-content-around align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sunrise">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
            <path d="M3 21l18 0" />
            <path d="M12 9v-6l3 3m-6 0l3 -3" />
        </svg>
        <p>Alumno de mañana: <?= $alumnoManana ?></p>
        <p>Alumno de tarde: <?= $alumnoTarde ?></p>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sunset">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
            <path d="M3 21l18 0" />
            <path d="M12 3v6l3 -3m-6 0l3 3" />
        </svg>
    </div>
    <div class="d-flex flex-row justify-content-around align-items-center">
        <div class="caja d-flex flex-row align-items-center" id="guardarBtn">
            <p>Guardar</p>
        </div>
        <div class="caja d-flex flex-row align-items-center" id="cancelarBtn">
            <p>Cancelar</p>
        </div>        
    </div>

</div>

