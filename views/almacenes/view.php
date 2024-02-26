<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Almacenes $model */

$this->title = $model->id_almacen;
$this->params['breadcrumbs'][] = ['label' => 'Almacenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="almacenes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_almacen' => $model->id_almacen], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_almacen' => $model->id_almacen], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_almacen',
            'aula',
            'capacidad',
        ],
    ]) ?>

</div>
