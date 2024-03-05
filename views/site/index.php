<?php

    /** @var yii\web\View $this */
    use dosamigos\chartjs\ChartJs;

    $this->title = 'Inicio';

?>

<div class="site-index">

    <!-- <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div> -->

    <div class="body-content">

        <div class="row col-lg-12">
            
            <div class="col-lg-6">
                <?= ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'height' => 480,
                        'width' => 480
                    ],
                    'data' => [
                        'labels' => ['Disponibles', 'No disponibles', 'Averiados'],
                        'datasets' => [[
                            'label' => "Número de portatiles",
                            'backgroundColor' => ['#4E5AE3', '#44B86B', '#E8685C'],
                            'borderColor' => '#000000',
                            'data' => [$portatiles_disponibles, $portatiles_no_disponibles, $portatiles_averiados]
                        ]]
                    ]
                ]); ?>
            </div>

            <div class="col-lg-6">
                <?= ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'height' => 480,
                        'width' => 480
                    ],
                    'data' => [
                        'labels' => ['Disponibles', 'No disponibles', 'Averiados'],
                        'datasets' => [[
                            'label' => "Número de cargadores",
                            'backgroundColor' => ['#4E5AE3', '#44B86B', '#E8685C'],
                            'borderColor' => '#000000',
                            'data' => [$cargadores_disponibles, $cargadores_no_disponibles, $cargadores_averiados]
                        ]]
                    ]
                ]); ?>
            </div>

        </div>
        <div class="row col-lg-12">

            <div class="col-lg-6">
                <?= ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'height' => 800,
                        'width' => 800
                    ],
                    'data' => [
                        'labels' => array_column($uso_ciclo, 'nombre'),
                        'datasets' => [[
                            'label' => "Alumnos usando pórtatiles",
                            'backgroundColor' => ['#4E5AE3', '#44B86B', '#E8685C'],
                            'borderColor' => '#000000',
                            'data' => array_column($uso_ciclo, 'cantidad')
                        ]]
                    ]
                ]); ?>
            </div>

            <!-- <div class="col-lg-6">
                 ChartJs::widget([
                    'type' => 'radar',
                    'options' => [
                        'height' => 800,
                        'width' => 800
                    ],
                    'data' => [
                        'labels' => $array_column($almacen, 'aula'),
                        'datasets' => [[
                            'label' => "Almacenamiento máximo",
                            'backgroundColor' => ['#4E5AE3', '#44B86B', '#E8685C'],
                            'borderColor' => '#000000',
                            'data' => array_column($uso_ciclo, 'cantidad')
                        ], [
                            'label' => "Almacenamiento actual",
                            'backgroundColor' => ['#4E5AE3', '#44B86B', '#E8685C'],
                            'borderColor' => '#000000',
                            'data' => array_column($uso_ciclo, 'cantidad')
                        ]]
                    ]
                ]); 
            </div> -->

            <!-- <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div> -->
        </div>

    </div>
</div>
