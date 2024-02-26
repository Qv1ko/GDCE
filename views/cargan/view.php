<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cargan $model */

$this->title = $model->id_carga;
$this->params['breadcrumbs'][] = ['label' => 'Cargans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cargan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_carga' => $model->id_carga], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_carga' => $model->id_carga], [
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
            'id_carga',
            'id_portatil',
            'id_cargador',
        ],
    ]) ?>

</div>
