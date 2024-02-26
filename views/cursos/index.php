<?php

use app\models\Cursos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cursos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cursos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cursos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_curso',
            'nombre',
            'nombre_corto',
            'curso',
            'turno',
            //'aula',
            //'tutor',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Cursos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_curso' => $model->id_curso]);
                 }
            ],
        ],
    ]); ?>


</div>
