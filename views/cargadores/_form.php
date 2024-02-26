<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cargadores $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cargadores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'potencia')->textInput() ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_almacen')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
