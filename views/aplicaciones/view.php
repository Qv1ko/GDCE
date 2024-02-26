<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Aplicaciones $model */

$this->title = $model->id_aplicacion;
$this->params['breadcrumbs'][] = ['label' => 'Aplicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="aplicaciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_aplicacion' => $model->id_aplicacion], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_aplicacion' => $model->id_aplicacion], [
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
            'id_aplicacion',
            'aplicacion',
            'id_portatil',
        ],
    ]) ?>

</div>
