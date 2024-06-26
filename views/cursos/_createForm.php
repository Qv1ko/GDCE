<?php

    /** @var yii\web\View $this */
    /** @var app\models\Cursos $model */
    /** @var yii\widgets\ActiveForm $form */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

?>

<div class="cursos-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

        <!-- Campo para el nombre del curso -->
        <div>
            <?= $form->field($model, 'nombre', [
                'inputOptions' => [
                    'placeholder' => 'ej: Desarrollo de Aplicaciones Multiplataforma',
                    'class' => 'form-control',
                ],
            ])->label($model->getAttributeLabel('nombre'))->textInput(['maxlength' => true]) ?>
        </div>

        <!-- Campo desplegable para seleccionar el curso -->
        <div>
            <?= $form->field($model, 'curso')->label($model->getAttributeLabel('curso'))->dropDownList(
                ['Primer curso' => 'Primer curso', 'Segundo curso' => 'Segundo curso'],
                ['prompt' => 'Selecciona el curso']
            ) ?>
        </div>

        <!-- Campo desplegable para seleccionar el turno -->
        <div>
            <?= $form->field($model, 'turno')->label($model->getAttributeLabel('turno'))->dropDownList(
                ['Mañana' => 'Mañana', 'Tarde' => 'Tarde'],
                ['prompt' => 'Selecciona un turno']
            ) ?>
        </div>

        <div class="row">
            <!-- Campo para el aula -->
            <div class="col-md-6">
                <?= $form->field($model, 'aula', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 011N',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('aula'))->textInput(['maxlength' => true]) ?>
            </div>
            <!-- Campo para el tutor -->
            <div class="col-md-6">
                <?= $form->field($model, 'tutor', [
                    'inputOptions' => [
                        'placeholder' => 'ej: Alberto García',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('tutor'))->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row d-flex justify-content-around">
            <!-- Botón para enviar el formulario -->
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
            <!-- Botón para cancelar y cerrar el modal -->
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
