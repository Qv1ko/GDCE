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
                <canvas id="graficoEstado" width="400" height="400"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    var ctx = document.getElementById('graficoEstado').getContext('2d');
                    var graficoEstado = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Disponibles', 'No disponibles', 'Averiados'],
                            datasets: [{
                                label: 'Portátiles',
                                backgroundColor: ['#00F377', '#ECE3FF', '#FF0033'],
                                borderColor: '#000000',
                                data: [<?=$portatiles_disponibles?>, <?=$portatiles_no_disponibles?>, <?=$portatiles_averiados?>]
                            }, {
                                label: 'Cargadores',
                                backgroundColor: ['#00F377', '#ECE3FF', '#FF0033'],
                                borderColor: '#000000',
                                data: [<?=$cargadores_disponibles?>, <?=$cargadores_no_disponibles?>, <?=$cargadores_averiados?>]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                </script>
            </div>

            
        </div>

        <hr>

        <div class="row col-lg-12">

            <div class="col-lg-6">

            </div>

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

        <hr>

        <div class="row col-lg-12">
            <div class="col-lg-6">
                <?= ChartJs::widget([
                    'type' => 'radar',
                    'options' => [
                        'height' => 400,
                        'width' => 400
                    ],
                    'data' => [
                        'labels' => ["Almacen 1", "Almacen 2", "Almacen 3", "Almacen 4", "Almacen 5", "Almacen 6", "Almacen 7"],
                        'datasets' => [
                            [
                                'label' => "Capacidad máxima",
                                'backgroundColor' => "#FF003316",
                                'borderColor' => "#FF0033",
                                'pointBackgroundColor' => "#FF0033",
                                'pointBorderColor' => "#E3E3E3",
                                'pointHoverBackgroundColor' => "#E3E3E3",
                                'pointHoverBorderColor' => "#FF0033",
                                'data' => [65, 59, 90, 81, 56, 55, 40]
                            ], [
                                'label' => "Capacidad ocupada actual",
                                'backgroundColor' => "#4040FF16",
                                'borderColor' => "#4040FF",
                                'pointBackgroundColor' => "#4040FF",
                                'pointBorderColor' => "#E3E3E3",
                                'pointHoverBackgroundColor' => "#E3E3E3",
                                'pointHoverBorderColor' => "#4040FF",
                                'data' => [28, 48, 40, 19, 28, 27, 28]
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>

        </div>

    </div>
</div>
