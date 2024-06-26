<?php

    /** @var yii\web\View $this */

    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\web\View;

    // Registro del archivo JavaScript jQuery
    $this->registerJsFile('@web/js/jquery.js', ['position' => View::POS_HEAD]);

?>

<div class="container">
    <div class="d-flex flex-row justify-content-around align-items-center">

        <!-- Columna para mostrar el estado del dispositivo -->
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

        <!-- Columna para mostrar el almacén -->
        <div class="col-4 d-flex flex-column align-items-center text-center" style="margin: 16px 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-building-warehouse">
                <title>Almacén</title>
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 21v-13l9 -4l9 4v13" />
                <path d="M13 13h4v8h-10v-6h6" />
                <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3" />
            </svg>
            <p style="margin-top: 8px;">
                <?= $almacen ? 'Aula ' . Html::encode($almacen) : 'Sin almacén' ?>
            </p>
        </div>

        <!-- Columna para mostrar el estado del cargador -->
        <div class="col-4 d-flex flex-column align-items-center text-center" style="margin: 16px 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-battery-charging">
                <title>Cargador</title>    
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M16 7h1a2 2 0 0 1 2 2v.5a.5 .5 0 0 0 .5 .5a.5 .5 0 0 1 .5 .5v3a.5 .5 0 0 1 -.5 .5a.5 .5 0 0 0 -.5 .5v.5a2 2 0 0 1 -2 2h-2" />
                <path d="M8 7h-2a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h1" />
                <path d="M12 8l-2 4h3l-2 4" />
            </svg>
            <p style="margin-top: 8px;">
                <?= $cargador ? 'Cargador ' . Html::encode($cargador) : 'Sin cargador' ?>
            </p>
        </div>

    </div>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <?php if ($portatil->estado !== 'Averiado'): ?>
            <!-- Reserva de alumno de mañana -->
            <div class="col-lg-8 d-flex flex-row justify-content-start align-items-center" style="margin: 16px 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sunrise" style="margin-right: 8px;">
                    <title>Alumno de mañana</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
                    <path d="M3 21l18 0" />
                    <path d="M12 9v-6l3 3m-6 0l3 -3" />
                </svg>
                <?php
                if (!$alumnoManana && !$alumnoTarde) {
                    echo Html::dropDownList('alumnosManana', null, $listaAlumnosManana, [
                        'prompt' => 'Reservar alumno de mañana', 
                        'class' => 'form-control',
                        'onchange' => 'var idManana = $(this).val();'
                    ]);
                } elseif ($alumnoManana) {
                    echo '<p>Alumno de mañana: ' . Html::encode($alumnoManana->nombreCompleto) . '</p>';
                } else {
                    echo Html::dropDownList('alumnosManana', null, $listaAlumnosSoloManana, [
                        'prompt' => 'Reservar alumno de mañana',
                        'class' => 'form-control',
                        'onchange' => 'var idManana = $(this).val();'
                    ]);
                }
                ?>
            </div>
            <!-- Reserva de alumno de tarde -->
            <div class="col-lg-8 d-flex flex-row justify-content-start align-items-center" style="margin: 16px 0">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-sunset" style="margin-right: 8px;">
                    <title>Alumno de tarde</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 17h1m16 0h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7m-9.7 5.7a4 4 0 0 1 8 0" />
                    <path d="M3 21l18 0" />
                    <path d="M12 3v6l3 -3m-6 0l3 3" />
                </svg>
                <?php
                if (!$alumnoTarde && !$alumnoManana) {
                    echo Html::dropDownList('alumnosTarde', null, $listaAlumnosTarde, [
                        'prompt' => 'Reservar alumno de tarde', 
                        'class' => 'form-control',
                        'onchange' => 'var idTarde = $(this).val();'
                    ]);
                } elseif ($alumnoTarde) {
                    echo '<p>Alumno de tarde: ' . Html::encode($alumnoTarde->nombreCompleto) . '</p>';
                } else {
                    echo Html::dropDownList('alumnosTarde', null, $listaAlumnosSoloTarde, [
                        'prompt' => 'Reservar alumno de tarde', 
                        'class' => 'form-control',
                        'onchange' => 'var idTarde = $(this).val();'
                    ]);
                }
                ?>
            </div>
        <?php else: ?>
            <h3 style="margin: 24px 0;">El portátil no se puede reservar porque está averiado</h3>
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
    // Evento de clic para el botón de guardar
    $("#guardarBtn").click(function() {

        // Obtener los valores seleccionados para alumnos de mañana y tarde
        var idManana = $('select[name="alumnosManana"]').val();
        var idTarde = $('select[name="alumnosTarde"]').val();

        // Verificar si al menos uno de los select tiene un valor seleccionado
        if (idManana !== null || idTarde !== null) {
            // Enviar datos a través de una solicitud AJAX
            $.ajax({
                url: '<?= Url::to(['alumnos/reservar']) ?>',
                type: "POST",
                data: {
                    portatil: <?= $portatil->id_portatil ?>,
                    alumnoManana: (idManana === null) ? <?= $alumnoManana === null ? 'null' : $alumnoManana->id_alumno ?> : idManana,
                    alumnoTarde: (idTarde === null) ? <?= $alumnoTarde === null ? 'null' : $alumnoTarde->id_alumno ?> : idTarde
                },
                success: function(response) {
                    location.href = '<?= Url::to(['index']) ?>'; // Redirigir al índice tras la respuesta exitosa
                },
                error: function(xhr, status, error) {
                }
            });
        } else {
            location.href = '<?= Url::to(['index']) ?>'; // Redirigir al índice si no hay selección
        }
        
    });
</script>
