<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Cargadores $model */

    $this->title = 'Editar cargador ' . $model->codigo;

?>

<div class="cargadores-update">
    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>
        
        <?= $this->render('_updateForm', [
            'model' => $model,
        ]) ?>

    </div>
</div>
