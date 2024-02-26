<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cargan $model */

$this->title = 'Create Cargan';
$this->params['breadcrumbs'][] = ['label' => 'Cargans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
