<?php

use app\models\Alumnos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumnos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Alumnos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_alumno',
            'dni',
            'nombre',
            'apellidos',
            'estado_matricula',
            //'id_portatil',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Alumnos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_alumno' => $model->id_alumno]);
                 }
            ],
        ],
    ]); ?>


</div>
