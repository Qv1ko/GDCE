<?php

    /** @var yii\web\View $this */
    /** @var yii\data\ActiveDataProvider $dataProvider */

    use yii\helpers\Html;
    use yii\widgets\ListView;

    // Título de la página
    $this->title = 'Aplicaciones';

    // Registra archivos JavaScript necesarios
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/modalCreate.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="aplicaciones-index">
    <div class="container">

        <!-- Título de la página -->
        <h1><?= Html::encode($this->title) ?></h1>

        <!-- ListView para mostrar las aplicaciones -->
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_aplicaciones', // Vista para cada elemento
            'layout' => "{items}",
            'options' => ['class' => 'row'],
            'itemOptions' => ['class' => 'col-sm-6 col-md-4 col-lg-3 mb-3'],
        ]); ?>

        <!-- Botón para añadir una nueva aplicación -->
        <div class="row d-flex justify-content-around">
            <?= Html::a('<div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus" style="margin-right: 4px;">
                    <title>Añadir aplicación</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                </svg>
                <span>Añadir aplicación</span>
            </div>', [''], ['class' => 'btn btn-success', 'id' => 'botonCreate']) ?>
        </div>

    </div>
</div>

<!-- Contenedor para el modal de añadir aplicación -->
<div class="container">
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h2>Añadir aplicación</h2>
                </div>
                <div class="modal-body">
                    <?= $this->render('_createForm', ['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
