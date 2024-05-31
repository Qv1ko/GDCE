<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Almacenes;
    use app\models\Aplicaciones;
use app\models\Cargadores;

    /** @var yii\web\View $this */
    /** @var app\models\Portatiles $model */
    /** @var yii\widgets\ActiveForm $form */

?>

<div class="portatiles-form">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>

            <div>
                <?= $form->field($model, 'codigo', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 001A',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('codigo'))->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'marca', [
                        'inputOptions' => [
                            'placeholder' => 'ej: HP',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('marca'))->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'modelo', [
                        'inputOptions' => [
                            'placeholder' => 'ej: ProBook',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('modelo'))->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'procesador', [
                        'inputOptions' => [
                            'placeholder' => 'ej: Intel i5',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('procesador'))->textInput(['maxlength' => true]) ?>
                </div>

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
                <div class="col-md-6">
                    <?= $form->field($model, 'dispositivo_almacenamiento')->label($model->getAttributeLabel('dispositivo_almacenamiento'))->dropDownList(
                        ['HDD' => 'Dispositivo HDD', 'SSD' => 'Dispositivo SSD'],
                        ['prompt'=>'Selecciona un dispositivo']
                    ) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'capacidad', [
                        'inputOptions' => [
                            'placeholder' => 'ej: 1000',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('capacidad'))->textInput() ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label">Aplicaciones instaladas</label>
                <div class="row">
                    <?php foreach (Aplicaciones::getListaAplicaciones() as $columna): ?>
                        <div class="col-sm-4">
                            <?php foreach ($columna as $aplicaciones): ?>
                                <div class="checkbox">
                                    <?= Html::checkbox('aplicaciones[]', null, ['label' => $aplicaciones, 'value' => $aplicaciones]) ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div>
                <?= $form->field($model, 'estado')->label($model->getAttributeLabel('estado'))->dropDownList(
                    ['Disponible' => 'Disponible', 'Averiado' => 'Averiado'],
                    ['prompt'=>'Selecciona un estado']
                ) ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Cargador</label>
                    <?= Html::dropDownList(
                        'cargador',
                        null,
                        Cargadores::getCargadoresLibres(),
                        ['prompt' => 'Selecciona un cargador', 'class' => 'form-control']
                    ) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'id_almacen')->dropDownList(
                        Almacenes::getAlmacenesDisponibles(),
                        ['prompt' => 'Selecciona un almacén']
                    ) ?>
                </div>
            </div>

            <div class="row d-flex justify-content-around">
                <?= Html::submitButton('<div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus" style="margin-right: 4px;">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 12h6" />
                        <path d="M12 9v6" />
                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                    </svg>
                    <span>Guardar</span>
                </div>', ['class' => 'btn btn-success']) ?>
                <?= Html::button('<div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-x" style="margin-right: 4px;">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                        <path d="M9 9l6 6m0 -6l-6 6" />
                    </svg>
                    <span>Cancelar</span>
                </div>', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal', 'aria-label' => 'Close']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
