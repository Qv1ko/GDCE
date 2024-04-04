<?php

    use app\models\Almacenes;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;

    /** @var yii\web\View $this */
    /** @var yii\data\ActiveDataProvider $dataProvider */

    $this->title = 'Gestión de almacenes';

?>

<div class="almacenes-index">

    <h1>GESTIÓN DE ALMACENES</h1>

    <?php // Añadir el campo de texto con el nombre 'search'
        echo Html::beginForm(['almacenes/index'], 'get', ['class' => 'form-inline', 'style' => 'margin-bottom: 20px']);
        echo Html::textInput('search', '', ['class' => 'form-control mr-sm-2']);
        echo Html::submitButton('Buscar', ['class' => 'btn btn-outline-success my-2 my-sm-0']);
        echo Html::endForm();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //'id_almacen',
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
                        return Html::a('<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>Editar', $url, ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Eliminar', $url, [
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
            <?= Html::a('Importar almacenes', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <p>
            <?= Html::a('Crear almacén', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
        <p>
            <?= Html::a('Exportar almacenes', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

</div>
