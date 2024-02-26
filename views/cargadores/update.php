<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cargadores $model */

$this->title = 'Update Cargadores: ' . $model->id_cargador;
$this->params['breadcrumbs'][] = ['label' => 'Cargadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cargador, 'url' => ['view', 'id_cargador' => $model->id_cargador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cargadores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
