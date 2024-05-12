<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Cursos $model */

    $this->title = $model->nombre . ' - ' . $model->curso;

?>

<div class="cursos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
