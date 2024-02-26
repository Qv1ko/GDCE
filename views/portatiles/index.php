<?php

use app\models\Portatiles;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Portatiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portatiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Portatiles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_portatil',
            'codigo',
            'marca',
            'modelo',
            'estado',
            //'procesador',
            //'memoria_ram',
            //'capacidad',
            //'dispositivo_almacenamiento',
            //'id_almacen',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Portatiles $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_portatil' => $model->id_portatil]);
                 }
            ],
        ],
    ]); ?>


</div>
