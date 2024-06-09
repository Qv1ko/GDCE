<?php

    /** @var yii\web\View $this */
    /** @var app\models\Cargadores $model */
    /** @var yii\widgets\ActiveForm $form */

    use app\models\Almacenes;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

?>

<div class="cargadores-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

        <div class="row">
            <!-- Campo de entrada para el código del cargador -->
            <div class="col-md-6">
                <?= $form->field($model, 'codigo', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 001A',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('codigo'))->textInput(['maxlength' => true]) ?>
            </div>
            <!-- Campo de entrada para la potencia del cargador -->
            <div class="col-md-6">
                <?= $form->field($model, 'potencia', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 60',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('potencia'))->textInput() ?>
            </div>
        </div>

        <div class="row">
            <!-- Campo de selección del estado del cargador -->
            <div class="col-md-6">
                <?= $form->field($model, 'estado')->label($model->getAttributeLabel('estado'))->dropDownList(
                    ['Disponible' => 'Disponible', 'Averiado' => 'Averiado'],
                    ['prompt' => 'Selecciona un estado']
                ) ?>
            </div>
            <!-- Campo de selección del almacén -->
            <div class="col-md-6">
                <?= $form->field($model, 'id_almacen')->dropDownList(
                    Almacenes::getAlmacenesDisponibles(),
                    ['prompt' => 'Selecciona un almacén']
                ) ?>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="row d-flex justify-content-around">
            <!-- Botón para guardar el formulario -->
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
            <!-- Botón para cancelar -->
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
