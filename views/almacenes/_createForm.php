<?php

    /** @var yii\web\View $this */
    /** @var app\models\Almacenes $model */
    /** @var yii\widgets\ActiveForm $form */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

?>

<div class="almacenes-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

        <div class="row">
            <div class="col-md-6">
                <!-- Campo para el aula del almacén -->
                <?= $form->field($model, 'aula', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 001A',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('aula'))->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <!-- Campo para la capacidad del almacén -->
                <?= $form->field($model, 'capacidad', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 50',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('capacidad'))->textInput() ?>
            </div>
        </div>
        <!-- Botones de acción -->
        <div class="row d-flex justify-content-around">
            <!-- Botón para guardar -->
            <?= Html::submitButton('<div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus" style="margin-right: 4px;">
                    <title>Guardar</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                </svg>
                <span>Guardar</span>
            </div>', ['class' => 'btn btn-success']) ?>
            <!-- Botón para cerrar el formulario -->
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
    <?php ActiveForm::end(); ?>
</div>
