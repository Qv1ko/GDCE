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
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            }
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
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            },
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
                <canvas id="graficoAlumnos" width="400" height="400"></canvas>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>

                    var ctx = document.getElementById('graficoAlumnos').getContext('2d');
                    var nombres = <?php echo json_encode(array_column($usoCiclo, 'nombre')); ?>;
                    var cantidades = <?php echo json_encode(array_column($usoCiclo, 'cantidad')); ?>;
                    var gradientColors = generateGradientColors('#4040ff', '#99FF33', nombres.length);

                    var graficoEstado = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: nombres,
                            datasets: [{
                                label: 'Alumnos usando pórtatiles',
                                backgroundColor: gradientColors,
                                borderColor: '#000000',
                                data: cantidades
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false,
                                }
                            }
                        }
                    });

                    // Colores degradados
                    function generateGradientColors(startColor, endColor, numColors) {
                        var start = hexToRgb(startColor);
                        var end = hexToRgb(endColor);
                        var colors = [];

                        for (var i = 0; i < numColors; i++) {
                            var r = Math.round(start.r + i * (end.r - start.r) / (numColors - 1));
                            var g = Math.round(start.g + i * (end.g - start.g) / (numColors - 1));
                            var b = Math.round(start.b + i * (end.b - start.b) / (numColors - 1));
                            colors.push('rgb(' + r + ',' + g + ',' + b + ')');
                        }

                        return colors;
                    }

                    // Hexadecimal a RGB
                    function hexToRgb(hex) {
                        var bigint = parseInt(hex.slice(1), 16);
                        var r = (bigint >> 16) & 255;
                        var g = (bigint >> 8) & 255;
                        var b = bigint & 255;
                        return { r: r, g: g, b: b };
                    }

                </script>
            </div>
        </div>

    </div>
</div>
