<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cargadores $model */

$this->title = $model->id_cargador;
$this->params['breadcrumbs'][] = ['label' => 'Cargadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cargadores-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_cargador' => $model->id_cargador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_cargador' => $model->id_cargador], [
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
            'id_cargador',
            'codigo',
            'potencia',
            'estado',
            'id_almacen',
        ],
    ]) ?>

</div>
