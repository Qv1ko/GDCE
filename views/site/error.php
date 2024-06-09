<?php

    /** @var yii\web\View $this */
    /** @var string $name */
    /** @var string $message */
    /** @var Exception$exception */

    use yii\helpers\Html;

    // Título de la página
    $this->title = $name;
    
?>

<div class="site-error container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Título de la página -->
            <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>

            <!-- Mensaje de error -->
            <div class="alert alert-danger mb-4">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p class="mb-4 text-center">
                Se produjo un error al procesar su solicitud
            </p>

            <!-- Enlace de contacto -->
            <p class="mb-4 text-center">
                <?= Html::a('Contáctanos', 'https://github.com/Qv1ko/GDCE/issues', ['target' => '_blank']) ?> si el error persiste
            </p>

            <!-- Enlace para volver al inicio -->
            <p class="text-center">
                <?= Html::a('Volver al inicio', ['site/index'], ['class' => 'btn btn-primary']) ?>
            </p>

        </div>
    </div>
</div>
