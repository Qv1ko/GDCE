<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Alumnos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="alumnos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_portatil')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
