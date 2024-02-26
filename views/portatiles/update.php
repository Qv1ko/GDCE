<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Portatiles $model */

$this->title = 'Update Portatiles: ' . $model->id_portatil;
$this->params['breadcrumbs'][] = ['label' => 'Portatiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_portatil, 'url' => ['view', 'id_portatil' => $model->id_portatil]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="portatiles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
