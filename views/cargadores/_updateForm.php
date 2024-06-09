<?php

    /** @var yii\web\View $this Vista actual */
    /** @var app\models\Cargadores $model Modelo de datos de Cargadores */
    /** @var yii\widgets\ActiveForm $form Formulario activo */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Almacenes;

    // Registro del archivo JavaScript jQuery
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="cargadores-form">
    <?php $form = ActiveForm::begin(['id' => 'updateForm', 'enableAjaxValidation' => true]); ?>

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
            <div class="col-md-6">
                <!-- Campo de selección del almacén -->
                <?= $form->field($model, 'id_almacen')->dropDownList(
                    Almacenes::getAlmacenesDisponibles(),
                    ['prompt' => 'Selecciona un almacén']
                ) ?>
            </div>
        </div>

        <div class="row d-flex justify-content-around">
            <!-- Botón para enviar el formulario -->
            <?= Html::submitButton('<div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh" style="margin-right: 4px;">
                    <title>Actualizar</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
                <span>Actualizar</span>
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
