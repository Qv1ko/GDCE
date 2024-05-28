<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Aplicaciones $model */

    $this->title = 'Editar ' . $model->aplicacion;

?>
<div class="aplicaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
