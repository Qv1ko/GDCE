<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Almacenes $model */

$this->title = 'Update Almacenes: ' . $model->id_almacen;
$this->params['breadcrumbs'][] = ['label' => 'Almacenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_almacen, 'url' => ['view', 'id_almacen' => $model->id_almacen]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="almacenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
