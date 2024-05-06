<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    /** @var yii\web\View $this */
    /** @var app\models\Portatiles $model */
    /** @var yii\widgets\ActiveForm $form */

?>

<div class="portatiles-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

        <div class="d-flex flex-row justify-content-around align-items-center">
            <?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?>
    
            <?= $form->field($model, 'modelo')->textInput(['maxlength' => true]) ?>
        </div>

        <!-- <#= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?> -->

        <div class="d-flex flex-row justify-content-around align-items-center">
            <?= $form->field($model, 'procesador')->textInput(['maxlength' => true]) ?>
    
            <?= $form->field($model, 'memoria_ram')->textInput() ?>
        </div>

        <div class="d-flex flex-row justify-content-around align-items-center">
            <?= $form->field($model, 'dispositivo_almacenamiento')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'capacidad')->textInput() ?>
        </div>

        <?= $form->field($model, 'id_almacen')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
