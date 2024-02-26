<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Almacenes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="almacenes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capacidad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
