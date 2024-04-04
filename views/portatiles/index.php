<?php

    use app\models\Portatiles;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;

    /** @var yii\web\View $this */
    /** @var yii\data\ActiveDataProvider $dataProvider */

    $this->title = 'Gestión de portátiles';

?>

<div class="portatiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::input('text','password1','', $options=['class'=>'form-control','maxlength'=>10, 'style'=>'width:350px']) ?></p>

    <p>
        <?= Html::a('Create Portatiles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id_portatil',
            'codigo',
            'portatil' => [
                'label' => 'Portátil',
                'value' => function ($model) {
                    return empty($model->marca)? '⚠️ Sin definir' : $model->marca . ' ' . $model->modelo;
                },
            ],
            'procesador' => [
                'label' => 'CPU',
                'value' => function ($model) {
                    return empty($model->procesador)? '⚠️ Sin definir' : $model->procesador;
                },
            ],
            'memoria_ram' => [
                'label' => 'RAM',
                'value' => function ($model) {
                    return empty($model->memoria_ram)? '⚠️ Sin definir' : $model->memoria_ram . ' GB';
                },
            ],
            'capacidad' => [
                'label' => 'Capacidad',
                'value' => function ($model) {
                    return empty($model->capacidad)? '⚠️ Sin definir' : $model->capacidad. ' GB ' . $model->dispositivo_almacenamiento;
                },
            ],
            [
                'header' => 'Aplicaciones instaladas',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('Aplicaciones', '/web/portatiles/portatil?='. $model->codigo, [
                        'class' => 'btn btn-primary'
                    ]);
                }
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
                'urlCreator' => function ($action, Portatiles $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_portatil' => $model->id_portatil]);
                },
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return '';
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(
                            '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>', $url, ['class' => 'btn btn-primary']);
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

</div>
