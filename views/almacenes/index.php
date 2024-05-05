<?php

    use app\models\Almacenes;
    use app\models\AlmacenesSearch;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;
    use yii\widgets\ActiveForm;
    use yii\data\ActiveDataProvider;

    // Título de la página
    $this->title = 'Gestión de almacenes';

    // Archivos JavaScript
    $this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/popup.js', ['position' => \yii\web\View::POS_HEAD]);

?>


<div class="almacenes-index">

    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
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
            'summary' => '',
        ]); ?>

        <div class="row d-flex justify-content-around">
            <p>
                <?= Html::a('<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12h6" /><path d="M12 9v6" /><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /></svg> Crear almacén', [''], ['class' => 'btn btn-success', 'id' => 'popup-button']) ?>
            </p>
        </div>
        
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
