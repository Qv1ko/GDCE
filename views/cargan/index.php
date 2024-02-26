<?php

use app\models\Cargan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cargans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cargan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_carga',
            'id_portatil',
            'id_cargador',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cargan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_carga' => $model->id_carga]);
                 }
            ],
        ],
    ]); ?>


</div>
