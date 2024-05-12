<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /** @var yii\web\View $this */
    /** @var app\models\Cursos $model */
    /** @var yii\widgets\ActiveForm $form */

?>

<div class="cursos-form">

    <?php $form = ActiveForm::begin(['id' => 'cursos-form']); ?>

        <?= $form->field($model, 'nombre', [
            'inputOptions' => [
                'placeholder' => $model->getAttributeLabel('nombre'),
                'class' => 'form-control',
            ],
        ])->label(false)->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'curso')->label(false)->dropDownList(
            ['Primer curso' => 'Primer curso', 'Segundo curso' => 'Segundo curso'],
            ['prompt'=>'Selecciona el curso']
        ) ?>

        <?= $form->field($model, 'turno')->label(false)->dropDownList(
            ['Mañana' => 'Mañana', 'Tarde' => 'Tarde'],
            ['prompt'=>'Selecciona un turno']
        ) ?>

        <?= $form->field($model, 'aula', [
            'inputOptions' => [
                'placeholder' => $model->getAttributeLabel('aula'),
                'class' => 'form-control',
            ],
        ])->label(false)->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'tutor', [
            'inputOptions' => [
                'placeholder' => $model->getAttributeLabel('tutor'),
                'class' => 'form-control',
            ],
        ])->label(false)->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
            Cancelar
        </button>

    <?php ActiveForm::end(); ?>

</div>
