<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Alumnos $model */

    $this->title = 'Editar alumno/a ' . $model->nombreCompleto;

?>

<div class="alumnos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_updateForm', [
        'model' => $model,
        'cursoActualManana' => $cursoActualManana,
        'cursoActualTarde' => $cursoActualTarde,
    ]) ?>

</div>
