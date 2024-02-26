<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alumnos $model */

$this->title = 'Create Alumnos';
$this->params['breadcrumbs'][] = ['label' => 'Alumnos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alumnos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
