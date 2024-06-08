<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Almacenes $model */

?>

<div class="almacenes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
