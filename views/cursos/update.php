<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cursos $model */

$this->title = 'Update Cursos: ' . $model->id_curso;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_curso, 'url' => ['view', 'id_curso' => $model->id_curso]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cursos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
