<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cursan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cursan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'curso_academico')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_alumno')->textInput() ?>

    <?= $form->field($model, 'id_curso')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
