<?php

use app\models\Cargadores;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cargadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargadores-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cargadores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cargador',
            'codigo',
            'potencia',
            'estado',
            'id_almacen',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cargadores $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_cargador' => $model->id_cargador]);
                 }
            ],
        ],
    ]); ?>


</div>
