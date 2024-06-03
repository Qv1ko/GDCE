<?php

    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\Cursos $model */

?>

<div class="cursos-update">

    <?= $this->render('_updateForm', [
        'model' => $model,
    ]) ?>

</div>
