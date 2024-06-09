<?php

    use yii\data\ArrayDataProvider;
    use yii\grid\GridView;
    use yii\helpers\ArrayHelper;

    // Aplicaciones del modelo ordenadas
    $aplicaciones = $model->aplicaciones;
    ArrayHelper::multisort($aplicaciones, 'aplicacion');

    // ArrayDataProvider con las aplicaciones ordenadas
    $dataProvider = new ArrayDataProvider([
        'allModels' => $aplicaciones,
        'pagination' => false, // Desactiva la paginación
    ]);

?>

<!-- Mostrar las aplicaciones en una tabla -->
<div class="portatiles-aplicaciones">
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'showHeader' => false, // Oculta el encabezado de la tabla
            'columns' => [
                [
                    'value' => function ($aplicaciones) {
                        return $aplicaciones->aplicacion;
                    },
                    // Estilo para las celdas de contenido
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return [
                            // Color de fondo de las filas
                            'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                        ];
                    },
                ],
            ],
            'emptyText' => 'No tiene aplicaciones.', // Texto a mostrar cuando no hay datos
            'summary' => '', // Oculta el resumen
        ]); ?>
    </div>
</div>
