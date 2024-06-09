<?php

    /** @var yii\web\View $this */
    /** @var app\models\Alumnos $model */
    /** @var app\models\Cursan $modelCursan */
    /** @var yii\widgets\ActiveForm $form */

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Cursos;
    use app\models\Portatiles;

    // Registra archivo de JavaScript
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="alumnos-form">
        <?php $form = ActiveForm::begin(['id' => 'updateForm', 'enableAjaxValidation' => true]); ?>

            <!-- Campo para el DNI del alumno -->
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'dni', [
                        'inputOptions' => [
                            'placeholder' => 'ej: 66355049A o Z7574542A',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('dni'))->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <!-- Campo para el nombre del alumno -->
                <div class="col-md-6">
                    <?= $form->field($model, 'nombre', [
                        'inputOptions' => [
                            'placeholder' => 'ej: Alonso',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('nombre'))->textInput(['maxlength' => true]) ?>
                </div>
                <!-- Campo para los apellidos del alumno -->
                <div class="col-md-6">
                    <?= $form->field($model, 'apellidos', [
                        'inputOptions' => [
                            'placeholder' => 'ej: Gómez',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('apellidos'))->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <!-- Campo para el estado de la matrícula del alumno -->
                <div class="col-md-6">
                    <?= $form->field($model, 'estado_matricula')->label($model->getAttributeLabel('estado_matricula'))->dropDownList(
                        ['Matriculado' => 'Matriculado', 'No matriculado' => 'No matriculado'],
                        ['prompt' => 'Selecciona el estado de matrícula']
                    ) ?>
                </div>
                <!-- Campo de selección del portátil del alumno -->
                <div class="col-md-6">
                    <?= $form->field($model, 'id_portatil')->label($model->getAttributeLabel('id_portatil'))->dropDownList(
                        Portatiles::getCargadoresLibresmpa($model->id_portatil),
                        ['prompt' => 'Selecciona un portátil', 'class' => 'form-control']
                    ) ?>
                </div>
            </div>

            <!-- Campos para la selección de cursos de mañana y tarde -->
            <div class="row">
                <div class="col-md-6 form-group">
                    <label class="control-label">Curso de mañana</label>
                    <?= Html::dropDownList(
                        'cursoManana',
                        $cursoActualManana,
                        Cursos::getListaCursosManana(),
                        ['prompt' => 'Selecciona un curso de mañana', 'class' => 'form-control']
                    ) ?>
                </div>
                <div class="col-md-6 form-group">
                    <label class="control-label">Cursos de tarde</label>
                    <?= Html::dropDownList(
                        'cursoTarde',
                        $cursoActualTarde,
                        Cursos::getListaCursosTarde(),
                        ['prompt' => 'Selecciona un curso de tarde', 'class' => 'form-control']
                    ) ?>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="row d-flex justify-content-around">
                <!-- Botón de actualizar -->
                <?= Html::submitButton('<div class="d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-refresh" style="margin-right: 4px;">
                        <title>Actualizar</title>
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                    </svg>
                    <span>Actualizar</span>
                </div>', ['class' => 'btn btn-success']) ?>
                <!-- Botón de cancelar -->
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
</div>
