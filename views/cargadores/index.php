<?php

    use app\models\Cargadores;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;

    /** @var yii\web\View $this */
    /** @var yii\data\ActiveDataProvider $dataProvider */

    $this->title = 'Gestión de cargadores';

?>

<div class="cargadores-index">

    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'codigo',
                'potencia' => [
                    'label' => 'Potencia',
                    'value' => function ($model) {
                        return empty($model->potencia)? '⚠️ Sin definir' : $model->potencia . ' W';
                    },
                ],
                'estado',
                'id_almacen' => [
                    'label' => 'Almacén',
                    'value' => function ($model) {
                        return empty($model->id_almacen)? '⚠️ Sin definir' : $model->id_almacen;
                    },
                ],
                [
                    'header' => 'Botones de gestión',
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Cargadores $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id_cargador' => $model->id_cargador]);
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
            'summary' => '',
        ]); ?>

        <p>
            <?= Html::a('Create Cargadores', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

    </div>

</div>
