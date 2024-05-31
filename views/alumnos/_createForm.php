<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use app\models\Cursos;
    use app\models\Portatiles;

    /** @var yii\web\View $this */
    /** @var app\models\Alumnos $model */
    /** @var app\models\Cursan $modelCursan */
    /** @var yii\widgets\ActiveForm $form */

    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="alumnos-form">
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>

            <div>
                <?= $form->field($model, 'dni', [
                    'inputOptions' => [
                        'placeholder' => 'ej: 66355049A o Z7574542A',
                        'class' => 'form-control',
                    ],
                ])->label($model->getAttributeLabel('dni'))->textInput(['maxlength' => true]) ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'nombre', [
                        'inputOptions' => [
                            'placeholder' => 'ej: Alonso',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('nombre'))->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'apellidos', [
                        'inputOptions' => [
                            'placeholder' => 'ej: Gómez',
                            'class' => 'form-control',
                        ],
                    ])->label($model->getAttributeLabel('apellidos'))->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div>
                <?= $form->field($model, 'estado_matricula')->label($model->getAttributeLabel('estado_matricula'))->dropDownList(
                    ['Matriculado' => 'Matriculado', 'No matriculado' => 'No matriculado'],
                    ['prompt' => 'Selecciona el estado de matrícula']
                ) ?>
            </div>

            <div>
                <label class="control-label">Curso de mañana</label>
                <?= Html::dropDownList(
                    'cursoManana',
                    null,
                    Cursos::getListaCursosManana(),
                    ['prompt' => 'Selecciona un curso de mañana', 'class' => 'form-control']
                ) ?>
            </div>

            <div>
                <label class="control-label">Cursos de tarde</label>
                <?= Html::dropDownList(
                    'cursoTarde',
                    null,
                    Cursos::getListaCursosTarde(),
                    ['prompt' => 'Selecciona un curso de tarde', 'class' => 'form-control']
                ) ?>
            </div>

            <div>
                <?= $form->field($model, 'id_portatil')->label($model->getAttributeLabel('id_portatil'))->dropDownList(
                    Portatiles::getPortatilesDisponibles(),
                    ['prompt'=>'Selecciona un portátil', 'class' => 'form-control']
                ) ?>
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
