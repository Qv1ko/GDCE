<?php

use app\models\Aplicaciones;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Aplicaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aplicaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Aplicaciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_aplicacion',
            'aplicacion',
            'id_portatil',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Aplicaciones $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_aplicacion' => $model->id_aplicacion]);
                 }
            ],
        ],
    ]); ?>


</div>
