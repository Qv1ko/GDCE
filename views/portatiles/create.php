<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Portatiles $model */

    $this->title = 'Create Portatiles';
    $this->params['breadcrumbs'][] = ['label' => 'Portatiles', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    
?>

<div class="portatiles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
