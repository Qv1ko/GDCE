<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cursan $model */

$this->title = $model->id_cursa;
$this->params['breadcrumbs'][] = ['label' => 'Cursans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cursan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_cursa' => $model->id_cursa], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_cursa' => $model->id_cursa], [
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
            'id_cursa',
            'curso_academico',
            'id_alumno',
            'id_curso',
        ],
    ]) ?>

</div>
