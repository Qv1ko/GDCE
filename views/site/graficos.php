<?php

/** @var yii\web\View $this */

use dosamigos\chartjs\ChartJs;

$this->title = 'Panel';

$this->registerJsFile('@web/js/chart.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="site-graficos">

    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:200px;">
                    <h2>PORTÁTILES DISPONIBLES</h2>
                    <p style="font-size:64px;"><?= $portatilesDisponibles ?></p>
                    <p style="color: <?= $porcentajePortatilesDisponibles < 10 ? 'red' : $porcentajePortatilesDisponibles < 25 ? 'yellow' : 'green' ?>;"><?= $porcentajePortatilesDisponibles ?>%</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:200px;">
                    <h2>CARGADORES DISPONIBLES</h2>
                    <p style="font-size:64px;"><?= $cargadoresDisponibles ?></p>
                    <p style="color: <?= $porcentajeCargadoresDisponibles < 10 ? 'red' : $porcentajeCargadoresDisponibles < 25 ? 'yellow' : 'green' ?>;"><?= $porcentajeCargadoresDisponibles ?>%</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:200px;">
                    <h2>DISPOSITIVOS AVERIADOS</h2>
                    <p><span style="font-size:32px;"><?= $portatilesAveriados ?></span> portátiles</p>
                    <p><span style="font-size:32px;"><?= $cargadoresAveriados ?></span> cargadores</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="square" style="height:200px;">
                    <canvas id="graficoEstado"></canvas>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="square">
                    <canvas id="graficoAlmacenes" style="height:400px;"></canvas>
                </div>
            </div>

            <div class="col-md-6">
                <div class="square">
                    <canvas id="graficoCiclos" style="height:400px;"></canvas>
                </div>
            </div>

        </div>
    </div>

    <script>

        var ctx = document.getElementById('graficoEstado').getContext('2d');
        var graphData = [<?= $portatilesDisponibles ?>, <?= $cargadoresDisponibles ?>, <?= $portatilesNoDisponibles ?>, <?= $cargadoresNoDisponibles ?>, <?= $portatilesAveriados ?>, <?= $cargadoresAveriados ?>];
        var color = ['#00F377', '#00F377', '#b69dff', '#b69dff', '#ff001e', '#ff001e'];
        var etiquetas = ['Portátiles disponibles', 'Cargadores disponibles', 'Portátiles no disponibles', 'Cargadores no disponibles', 'Portátiles averiados', 'Cargadores averiados'];

        var graficoEstado = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: etiquetas,
                datasets: [{
                    label: ['Total'], 
                    backgroundColor: color,
                    borderColor: '#333333',
                    data: graphData
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
                    borderColor: '#ff001e',
                    pointBackgroundColor: '#ff001e',
                    pointBorderColor: '#e3e3e3',
                    pointHoverBackgroundColor: '#e3e3e3',
                    pointHoverBorderColor: '#ff001e'
                }, {
                    label: 'Capacidad ocupada actual',
                    data: dispositivos,
                    backgroundColor: 'rgba(64, 64, 255, 0.086)',
                    borderColor: '#574bfe',
                    pointBackgroundColor: '#574bfe',
                    pointBorderColor: '#e3e3e3',
                    pointHoverBackgroundColor: '#e3e3e3',
                    pointHoverBorderColor: '#574bfe'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Capacidad total y actual por almacén',
                        font: {
                            size: 16,
                            family: 'Roboto'
                        },
                        padding: {
                            bottom: 8
                        }
                    },
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        titleFont: {
                            size: 14,
                            family: 'Roboto'
                        },
                        bodyFont: {
                            size: 12,
                            family: 'Roboto'
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        suggestedMax: Math.max(...capacidad) + 5,
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('graficoCiclos').getContext('2d');
        var nombres = <?php echo json_encode(array_column($usoCiclo, 'nombre_corto')); ?>;
        var cantidades = <?php echo json_encode(array_column($usoCiclo, 'cantidad')); ?>;
        var gradientColors = generateGradientColors('#4040ff', '#99FF33', nombres.length);

        var graficoEstado = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombres,
                datasets: [{
                    label: 'Alumnos usando pórtatiles',
                    backgroundColor: ['#4040ff', '#99FF33'],
                    borderColor: '#000000',
                    data: cantidades
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Uso de portátiles por ciclo formativo',
                        font: {
                            size: 16,
                            family: 'Roboto'
                        },
                        padding: {
                            bottom: 8
                        }
                    },
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        font: {
                            size: 14,
                            family: 'Roboto'
                        }
                    },
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        suggestedMax: Math.max(...cantidades) + 5
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
            return {
                r: r,
                g: g,
                b: b
            };
        }
    </script>

</div>