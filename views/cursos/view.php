<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Cursos $model */

$this->title = $model->id_curso;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cursos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_curso' => $model->id_curso], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_curso' => $model->id_curso], [
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
            'id_curso',
            'nombre',
            'sigla',
            'curso',
            'turno',
            'aula',
            'tutor',
        ],
    ]) ?>

</div>
