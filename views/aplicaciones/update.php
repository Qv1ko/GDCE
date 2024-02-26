<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Aplicaciones $model */

$this->title = 'Update Aplicaciones: ' . $model->id_aplicacion;
$this->params['breadcrumbs'][] = ['label' => 'Aplicaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_aplicacion, 'url' => ['view', 'id_aplicacion' => $model->id_aplicacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aplicaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
