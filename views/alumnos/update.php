<div class="alumnos-update">
    <!-- Renderiza un formulario de actualización -->
    <?= $this->render('_updateForm', [
        'model' => $model,
        'cursoActualManana' => $cursoActualManana,
        'cursoActualTarde' => $cursoActualTarde,
    ]) ?>
</div>
