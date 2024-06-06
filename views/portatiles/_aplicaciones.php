<?php

    use yii\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\data\ArrayDataProvider;

    $aplicaciones = $model->aplicaciones;
    ArrayHelper::multisort($aplicaciones, 'aplicacion');

    $dataProvider = new ArrayDataProvider([
        'allModels' => $aplicaciones,
        'pagination' => false,
    ]);

?>

<div class="portatiles-aplicaciones">
    <div class="container">
        <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'showHeader' => false,
                'columns' => [
                    [
                        'value' => function ($aplicaciones) {
                            return $aplicaciones->aplicacion;
                        },
                        'contentOptions' => function ($model, $key, $index, $column) {
                            return [
                                'style' => 'background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                            ];
                        },
                    ],
                ],
                'emptyText' => 'No tiene aplicaciones.',
                'summary' => '',
            ]); ?>
        </div>
    </div>
</div>
