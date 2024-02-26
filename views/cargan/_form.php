<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cargan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="cargan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_portatil')->textInput() ?>

    <?= $form->field($model, 'id_cargador')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
