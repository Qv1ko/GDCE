<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cursos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cursos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre_corto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'turno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tutor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
