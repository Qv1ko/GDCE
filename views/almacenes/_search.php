<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /** @var yii\web\View $this */
    /** @var app\models\AlmacenesSearch $model */
    /** @var yii\widgets\ActiveForm $form */

?>

<div class="almacenes-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <div class="form-row">
            <div class="col">
                <!-- Campo de entrada para la búsqueda de almacenes -->
                <?= $form->field($model, 'searchString', [
                    'inputOptions' => [
                        'placeholder' => 'Buscar almacén',
                        'class' => 'form-control',
                    ],
                ])->label(false) ?>
            </div>
            <div class="col-auto">
                <!-- Botón para buscar -->
                <?= Html::submitButton('<div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search" style="margin-right: 4px;">
                        <title>Buscar</title>
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                        <path d="M21 21l-6 -6" />
                    </svg>
                    <span>Buscar</span>
                </div>', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
