<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cursan $model */

$this->title = 'Update Cursan: ' . $model->id_cursa;
$this->params['breadcrumbs'][] = ['label' => 'Cursans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_cursa, 'url' => ['view', 'id_cursa' => $model->id_cursa]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cursan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
