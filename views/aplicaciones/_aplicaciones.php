<?php

    use yii\helpers\Html;

    // Registra los archivos JavaScript necesarios para la página
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/modalUpdate.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="body-content">
    <div class="container">
        <div class="row">
            <!-- Tarjeta de la aplicación -->
            <div class="col-12 mb-4">
                <div class="square">

                    <!-- Nombre de la aplicación -->
                    <h5><?= Html::encode($model->aplicacion) ?></h5>

                    <!-- Botón para editar la aplicación -->
                    <?= Html::a('<div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                            <title>Editar</title>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                            <path d="M16 5l3 3" />
                        </svg>
                    </div>', ['update', 'id_aplicacion' => $model->id_aplicacion], ['class' => 'btn btn-primary', 'id' => 'botonUpdate', 'data-code' => 'Editar ' . $model->aplicacion]); ?>

                    <!-- Botón para eliminar la aplicación -->
                    <?= Html::a('<div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">    
                            <title>Eliminar</title>
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                    </div>', ['delete', 'id_aplicacion' => $model->id_aplicacion], ['class' => 'btn btn-primary', 'data' => ['confirm' => '¿Estás seguro de que quieres eliminar esta aplicación?', 'method' => 'post']]) ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para la actualización de la aplicación -->
<div class="container">
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <!-- Título del modal -->
                    <h2 id="tituloModalUpdate"></h2>
                </div>
                <div class="modal-body">
                    <!-- Renderiza el formulario de actualización -->
                    <?= $this->render('_updateForm', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
