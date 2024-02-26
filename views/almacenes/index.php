<?php

use app\models\Almacenes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Almacenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="almacenes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Almacenes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_almacen',
            'aula',
            'capacidad',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Almacenes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_almacen' => $model->id_almacen]);
                 }
            ],
        ],
    ]); ?>


</div>
