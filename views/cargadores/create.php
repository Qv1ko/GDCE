<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Cargadores $model */

$this->title = 'Create Cargadores';
$this->params['breadcrumbs'][] = ['label' => 'Cargadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cargadores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
