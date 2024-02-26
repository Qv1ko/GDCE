<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Alumnos $model */

$this->title = $model->id_alumno;
$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="alumnos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_alumno' => $model->id_alumno], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_alumno' => $model->id_alumno], [
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
            'id_alumno',
            'dni',
            'nombre',
            'apellidos',
            'estado_matricula',
            'id_portatil',
        ],
    ]) ?>

</div>
