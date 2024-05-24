<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Almacenes $model */

    $this->title = 'Editar almacén ' . $model->aula;

?>

<div class="almacenes-update">
    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= $this->render('_updateForm', [
            'model' => $model,
        ]) ?>

    </div>
</div>
