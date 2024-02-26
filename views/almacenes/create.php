<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Almacenes $model */

$this->title = 'Create Almacenes';
$this->params['breadcrumbs'][] = ['label' => 'Almacenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="almacenes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
