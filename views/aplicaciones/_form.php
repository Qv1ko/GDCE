<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Aplicaciones $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="aplicaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aplicacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_portatil')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
