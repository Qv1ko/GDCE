<?php

    use app\models\Almacenes;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;

    // Título de la página
    $this->title = 'Gestión de almacenes';

    // Registro de archivos JavaScript
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/modalUpdate.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/modalCreate.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<style>
    .container, .container-sm, .container-md, .container-lg, .container-xl {
        max-width: 80%;
    }
</style>

<div class="almacenes-index">
    <div class="container">

        <!-- Título de la página -->
        <h1><?= Html::encode($this->title) ?></h1>

        <!-- Formulario de búsqueda -->
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <div class="table-responsive">
            <!-- GridView para mostrar los datos de los almacenes -->
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'label' => 'Aula',
                        'value' => function ($model) {
                            return $model->aula;
                        },
                        'headerOptions' => ['style' => 'color: #489FB5;'],
                        'contentOptions' => function ($model, $key, $index, $column) {
                            return [
                                'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                            ];
                        },
                    ],
                    [
                        'label' => 'Capacidad máxima',
                        'value' => function ($model) {
                            return ($model->capacidad != null) ? $model->capacidad . ' dispositivos' : 'Sin definir';
                        },
                        'headerOptions' => ['style' => 'color: #489FB5;'],
                        'contentOptions' => function ($model, $key, $index, $column) {
                            return [
                                'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                            ];
                        },
                    ],
                    [
                        'label' => 'Dispositivos almacenados',
                        'value' => function ($model) {
                            return Almacenes::getOcupacion($model->id_almacen) . ' dispositivos';
                        },
                        'headerOptions' => ['style' => 'color: #489FB5;'],
                        'contentOptions' => function ($model, $key, $index, $column) {
                            return [
                                'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                            ];
                        },
                    ],
                    [
                        // Botones de actualización y eliminación
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Almacenes $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_almacen' => $model->id_almacen]);
                        },
                        'template' => '{update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit" style="margin-right: 4px;">
                                        <title>Editar</title>
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    <span>Editar</span>
                                </div>', $url, ['class' => 'btn btn-primary', 'id' => 'botonUpdate', 'data-code' => 'Editar almacén ' . $model->aula]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash" style="margin-right: 4px;">
                                        <title>Eliminar</title>
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                    <span>Eliminar</span>
                                </div>', $url, ['class' => 'btn btn-primary', 'data-confirm' => '¿Estás seguro de que quieres borrar este almacén?', 'data-method' => 'post']);
                            }
                        ],
                        'contentOptions' => function ($model, $key, $index, $column) {
                            return [
                                'style' => 'text-align: center; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                            ];
                        },
                    ],
                ],
                'summary' => '', // Quita el resumen
            ]); ?>
        </div>

        <!-- Botón para añadir un nuevo almacén -->
        <div class="row d-flex justify-content-around">
            <?= Html::a('<div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus" style="margin-right: 4px;">
                    <title>Añadir almacén</title>
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 12h6" />
                    <path d="M12 9v6" />
                    <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                </svg>
                <span>Añadir almacén</span>
            </div>', [''], ['class' => 'btn btn-success', 'id' => 'botonCreate']) ?>
        </div>
        
    </div>
</div>

<!-- Modal para actualizar almacenes -->
<div class="container">
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h2 id="tituloModalUpdate"></h2>
                </div>
                <div class="modal-body">
                    <?= $this->render('_updateForm', [
                        'model' => $model,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear nuevos almacenes -->
<div class="container">
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h2>Crear almacén</h2>
                </div>
                <div class="modal-body">
                    <?= $this->render('_createForm', ['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
