<?php

use app\models\Cursan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cursans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cursan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cursa',
            'curso_academico',
            'id_alumno',
            'id_curso',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cursan $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_cursa' => $model->id_cursa]);
                 }
            ],
        ],
    ]); ?>


</div>
