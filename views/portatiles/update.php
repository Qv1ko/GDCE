<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Portatiles $model */

    $this->title = 'Editar portátil ' . $model->codigo;

?>

<div class="portatiles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,
        'aplicacionesInstaladas' => $aplicacionesInstaladas,
        'cargador' => $cargador,
    ]) ?>

</div>
