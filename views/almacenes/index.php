<?php

    use app\models\Almacenes;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;
    use yii\widgets\ActiveForm;

    // Título de la página
    $this->title = 'Gestión de almacenes';

    // Archivos JavaScript
    $this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/popup.js', ['position' => \yii\web\View::POS_HEAD]);

?>


<div class="almacenes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        echo Html::beginForm(['almacenes/index'], 'get', ['class' => 'form-inline', 'style' => 'margin-bottom: 20px']);
        echo Html::textInput('search', '', ['class' => 'form-control mr-sm-2']);
        echo Html::submitButton('Buscar', ['class' => 'btn btn-outline-success my-2 my-sm-0']);
        echo Html::endForm();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'aula',
            'capacidad',
            [
                'header' => 'Botones de gestión',
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Almacenes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_almacen' => $model->id_almacen]);
                },
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return '';
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>Editar', $url, ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>Eliminar', $url, [
                            'class' => 'btn btn-danger',
                            'data-confirm' => 'Are you sure you want to delete this item?',
                            'data-method' => 'post'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

    <div class="row d-flex justify-content-around">
        <p>
            <?= Html::a('Importar', ['create'] ,['class' => 'btn btn-success']) ?>
        </p>
        <p>
            <?= Html::a('Crear almacén', [''], ['class' => 'btn btn-success', 'id' => 'popup-button']) ?>
        </p>
        <p>
            <?= Html::a('Exportar almacenes', ['/almacenes/export-csv'], ['class' => 'btn btn-success'])?>
        </p>
    </div>

</div>

<!-- Pop Up para crear almacén -->
<div class="container">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Crear almacén</h2>
                    <!-- Botón cerrar -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $this->render('_form', ['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
