<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alumnos $model */

$this->title = 'Update Alumnos: ' . $model->id_alumno;
$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_alumno, 'url' => ['view', 'id_alumno' => $model->id_alumno]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alumnos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
