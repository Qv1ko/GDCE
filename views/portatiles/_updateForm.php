<?php

    use app\models\Almacenes;
    use app\models\Aplicaciones;
    use app\models\Cargadores;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    // Registro del archivo JavaScript jQuery
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="portatiles-form">
    <?php $form = ActiveForm::begin(['id' => 'updateForm', 'enableAjaxValidation' => true]); ?>

        <div class="row">

            <!-- Campo para el código del portátil -->
            <div class="col-md-3">
                <?= $form->field($model, 'codigo', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 001A',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('codigo'))->textInput(['maxlength' => true]) ?>
            </div>

            <!-- Campo para la marca del portátil -->
            <div class="col-md-4">
                <?= $form->field($model, 'marca', [
                    'inputOptions' => [
                        'placeholder' => 'ej: HP',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('marca'))->textInput(['maxlength' => true]) ?>
            </div>

            <!-- Campo para el modelo del portátil -->
            <div class="col-md-5">
                <?= $form->field($model, 'modelo', [
                    'inputOptions' => [
                        'placeholder' => 'ej: ProBook',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('modelo'))->textInput(['maxlength' => true]) ?>
            </div>

        </div>

        <div class="row">
            <!-- Campo para el procesador del portátil -->
            <div class="col-md-6">
                <?= $form->field($model, 'procesador', [
                    'inputOptions' => [
                        'placeholder' => 'ej: Intel i5',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('procesador'))->textInput(['maxlength' => true]) ?>
            </div>
            <!-- Campo para la memoria RAM del portátil -->
            <div class="col-md-6">
                <?= $form->field($model, 'memoria_ram', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 8',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('memoria_ram'))->textInput() ?>
            </div>
        </div>

        <div class="row">
            <!-- Campo para seleccionar el tipo de dispositivo de almacenamiento -->
            <div class="col-md-6">
                <?= $form->field($model, 'dispositivo_almacenamiento')->label($model->getAttributeLabel('dispositivo_almacenamiento'))->dropDownList(
                    ['HDD' => 'Dispositivo HDD', 'SSD' => 'Dispositivo SSD'],
                    ['prompt' => 'Selecciona un dispositivo']
                ) ?>
            </div>
            <!-- Campo para la capacidad de almacenamiento -->
            <div class="col-md-6">
                <?= $form->field($model, 'capacidad', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 1000',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('capacidad'))->textInput() ?>
            </div>
        </div>

        <!-- Sección para aplicaciones instaladas -->
        <div class="form-group">
            <label class="control-label">Aplicaciones instaladas</label>
            <div class="row">
                <?php foreach (Aplicaciones::getListaAplicaciones() as $columna): ?>
                    <div class="col-sm-4">
                        <?php foreach ($columna as $aplicacion): ?>
                            <div class="checkbox">
                                <?= Html::checkbox(
                                    'aplicaciones[]', 
                                    in_array($aplicacion, $aplicacionesInstaladas),
                                    ['label' => $aplicacion, 'value' => $aplicacion]
                                ) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Fila para estado, cargador y almacén -->
        <div class="row">

            <!-- Campo para seleccionar el estado del portátil -->
            <div class="col-md-4">
                <?= $form->field($model, 'estado')->label($model->getAttributeLabel('estado'))->dropDownList(
                    ['Disponible' => 'Disponible', 'Averiado' => 'Averiado'],
                    ['prompt' => 'Selecciona un estado']
                ) ?>
            </div>

            <!-- Campo para seleccionar el cargador -->
            <div class="col-md-4">
                <label class="control-label">Cargador</label>
                <?= Html::dropDownList(
                    'cargador',
                    $cargador ? $cargador->id_cargador : null,
                    $cargador ? Cargadores::getCargadoresLibresmca($cargador->id_cargador) : Cargadores::getCargadoresLibres(),
                    ['prompt' => 'Selecciona un cargador', 'class' => 'form-control']
                ) ?>
            </div>

            <!-- Campo para seleccionar el almacén -->
            <div class="col-md-4">
                <?= $form->field($model, 'id_almacen')->dropDownList(
                    Almacenes::getAlmacenesDisponibles(),
                    ['prompt' => 'Selecciona un almacén']
                ) ?>
            </div>

        </div>

        <!-- Botones de acción -->
        <div class="row d-flex justify-content-around">
            <?= Html::submitButton('<div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh" style="margin-right: 4px;">
                    <title>Actualizar</title>    
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                    <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                </svg>
                <span>Actualizar</span>
            </div>', ['class' => 'btn btn-success']) ?>
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
