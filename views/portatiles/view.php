<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Portatiles $model */

$this->title = $model->id_portatil;
$this->params['breadcrumbs'][] = ['label' => 'Portatiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="portatiles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_portatil' => $model->id_portatil], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_portatil' => $model->id_portatil], [
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
            'id_portatil',
            'codigo',
            'marca',
            'modelo',
            'estado',
            'procesador',
            'memoria_ram',
            'capacidad',
            'dispositivo_almacenamiento',
            'id_almacen',
        ],
    ]) ?>

</div>
