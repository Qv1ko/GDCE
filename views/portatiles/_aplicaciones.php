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
                    'aplicacion',
                ],
                'summary' => '',
            ]); ?>
        </div>
    </div>
</div>
