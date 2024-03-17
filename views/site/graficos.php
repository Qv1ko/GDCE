<?php

    /** @var yii\web\View $this */

    use dosamigos\chartjs\ChartJs;

    $this->title = 'Panel';

?>

<div class="site-index">

    <div class="body-content">

        <div class="row col-lg-12">

            <h1 class="col-12">Estado de los dispositivos</h1>

            <div class="col-lg-8">
                
            </div>
            
            <div class="col-lg-4">
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
                                data: [<?=$portatilesDisponibles?>, <?=$portatilesNoDisponibles?>, <?=$portatilesAveriados?>]
                            }, {
                                label: 'Cargadores',
                                backgroundColor: ['#00F377', '#ECE3FF', '#FF0033'],
                                borderColor: '#000000',
                                data: [<?=$cargadoresDisponibles?>, <?=$cargadoresNoDisponibles?>, <?=$cargadoresAveriados?>]
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

            <h1 class="col-12">Capacidad de los almacenes</h1>

            <div class="col-lg-5">
                <canvas id="graficoAlmacenes" width="400" height="400"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    var ctx = document.getElementById('graficoAlmacenes').getContext('2d');
                    var almacenes = <?php echo json_encode(array_map(function($item) { return $item['almacen']; }, $almacenes)); ?>;
                    var capacidad = <?php echo json_encode(array_map(function($item) { return $item['capacidad']; }, $almacenes)); ?>;
                    var dispositivos = <?php echo json_encode(array_map(function($item) { return $item['dispositivos']; }, $almacenes)); ?>;

                    var graficoAlmacenes = new Chart(ctx, {
                        type: 'radar',
                        data: {
                            labels: almacenes,
                            datasets: [{
                                label: 'Capacidad máxima',
                                data: capacidad,
                                backgroundColor: 'rgba(255, 0, 51, 0.086)',
                                borderColor: '#FF0033',
                                pointBackgroundColor: '#FF0033',
                                pointBorderColor: '#E3E3E3',
                                pointHoverBackgroundColor: '#E3E3E3',
                                pointHoverBorderColor: '#FF0033'
                            }, {
                                label: 'Capacidad ocupada actual',
                                data: dispositivos,
                                backgroundColor: 'rgba(64, 64, 255, 0.086)',
                                borderColor: '#4040FF',
                                pointBackgroundColor: '#4040FF',
                                pointBorderColor: '#E3E3E3',
                                pointHoverBackgroundColor: '#E3E3E3',
                                pointHoverBorderColor: '#4040FF'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                r: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>

            <div class="col-lg-7">

            </div>

        </div>

        <hr>

        <div class="row col-lg-12">

            <h1 class="col-12">Uso de los dispositivos</h1>

            <div class="col-lg-8">
                
            </div>

            <div class="col-lg-4">
                <?= ChartJs::widget([
                    'type' => 'pie',
                    'options' => [
                        'height' => 800,
                        'width' => 800
                    ],
                    'data' => [
                        'labels' => array_column($usoCiclo, 'nombre'),
                        'datasets' => [[
                            'label' => "Alumnos usando pórtatiles",
                            'backgroundColor' => ['#4E5AE3', '#44B86B', '#E8685C'],
                            'borderColor' => '#000000',
                            'data' => array_column($usoCiclo, 'cantidad')
                        ]]
                    ]
                ]); ?>
            </div>
        </div>

    </div>
</div>
