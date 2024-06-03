<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Portatiles $model */

?>

<div class="portatiles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,
        'aplicacionesInstaladas' => $aplicacionesInstaladas,
        'cargador' => $cargador,
    ]) ?>

</div>
