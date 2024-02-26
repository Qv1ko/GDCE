<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cargan $model */

$this->title = 'Update Cargan: ' . $model->id_carga;
$this->params['breadcrumbs'][] = ['label' => 'Cargans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_carga, 'url' => ['view', 'id_carga' => $model->id_carga]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cargan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
