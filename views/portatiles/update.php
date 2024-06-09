<div class="portatiles-update">
    <!-- Renderiza el formulario de actualización -->
    <?= $this->render('_updateForm', [
        'model' => $model,
        'aplicacionesInstaladas' => $aplicacionesInstaladas, // Lista de aplicaciones instaladas
        'cargador' => $cargador,
    ]) ?>
</div>
