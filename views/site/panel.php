<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

$this->title = 'Panel';

$this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile('@web/js/chart.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="site-panel">
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:240px;">
                    <h2>PORTÁTILES DISPONIBLES</h2>
                    <div class="d-flex flex-column justify-content-center">
                        <p class="font-weight-bold" style="font-size:64px;height: 80px;"><?= $portatilesDisponibles ?></p>
                        <p style="color: <?= $porcentajePortatilesDisponibles < 10 ? 'red' : ($porcentajePortatilesDisponibles < 25 ? 'yellow' : 'green') ?>;"><?= $porcentajePortatilesDisponibles ?>%</p>
                    </div>
                    <p>
                        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 6l11 0" />
                            <path d="M9 12l11 0" />
                            <path d="M9 18l11 0" />
                            <path d="M5 6l0 .01" />
                            <path d="M5 12l0 .01" />
                            <path d="M5 18l0 .01" />
                        </svg> Ver listado', [''], ['class' => 'btn btn-primary', 'id' => 'modal-portatiles-button']) ?>
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:240px;">
                    <h2>CARGADORES DISPONIBLES</h2>
                    <div class="d-flex flex-column justify-content-center">
                        <p class="font-weight-bold" style="font-size:64px;height: 80px;"><?= $cargadoresDisponibles ?></p>
                        <p style="color: <?= $porcentajeCargadoresDisponibles < 10 ? 'red' : ($porcentajeCargadoresDisponibles < 25 ? 'yellow' : 'green') ?>;"><?= $porcentajeCargadoresDisponibles ?>%</p>
                    </div>
                    <p>
                        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 6l11 0" />
                            <path d="M9 12l11 0" />
                            <path d="M9 18l11 0" />
                            <path d="M5 6l0 .01" />
                            <path d="M5 12l0 .01" />
                            <path d="M5 18l0 .01" />
                        </svg> Ver listado', [''], ['class' => 'btn btn-primary', 'id' => 'modal-cargadores-button']) ?>
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:240px;">
                    <h2>DISPOSITIVOS AVERIADOS</h2>
                    <p><span class="font-weight-bold" style="font-size:32px;"><?= $portatilesAveriados ?></span> portátiles</p>
                    <p><span class="font-weight-bold" style="font-size:32px;"><?= $cargadoresAveriados ?></span> cargadores</p>
                    <p>
                        <?= Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M9 6l11 0" />
                            <path d="M9 12l11 0" />
                            <path d="M9 18l11 0" />
                            <path d="M5 6l0 .01" />
                            <path d="M5 12l0 .01" />
                            <path d="M5 18l0 .01" />
                        </svg> Ver listado', [''], ['class' => 'btn btn-primary', 'id' => 'modal-averiados-button']) ?>
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="square" style="height:240px;">
                    <canvas id="graficoEstado"></canvas>
                </div>
            </div>

        </div>

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
</div>

<!-- Listado de portatil disponibles -->
<div class="container">
    <div class="modal fade" id="modalPortatiles" tabindex="-1" role="dialog" aria-labelledby="modalPortatilesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Portátiles disponibles</h2>
                    <!-- Botón cerrar -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= GridView::widget([
                        'dataProvider' => $listadoPortatilesDisponibles,
                        'columns' => [
                            [
                                'attribute' => 'codigo',
                                'label' => 'Código',
                            ],
                            [
                                'attribute' => 'almacen.aula',
                                'label' => 'Aula',
                            ],
                        ],
                        'summary' => '',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-portatiles-button').click(function(e) {
            // Cancela el envio a la nueva página
            e.preventDefault();
            // Muestra el id modalPortatiles
            $('#modalPortatiles').modal('show');
        });
    });
</script>

<!-- Listado de cargadores disponibles -->
<div class="container">
    <div class="modal fade" id="modalCargadores" tabindex="-1" role="dialog" aria-labelledby="modalCargadoresLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Cargadores disponibles</h2>
                    <!-- Botón cerrar -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= GridView::widget([
                        'dataProvider' => $listadoCargadoresDisponibles,
                        'columns' => [
                            [
                                'attribute' => 'codigo',
                                'label' => 'Código',
                            ],
                            [
                                'attribute' => 'almacen.aula',
                                'label' => 'Aula',
                            ],
                        ],
                        'summary' => '',
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-cargadores-button').click(function(e) {
            // Cancela el envio a la nueva página
            e.preventDefault();
            // Muestra el id modalPortatiles
            $('#modalCargadores').modal('show');
        });
    });
</script>

<!-- Listado de dispositivos averiados -->
<div class="container">
    <div class="modal fade" id="modalAveriados" tabindex="-1" role="dialog" aria-labelledby="modalAveriadosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Dispositivos averiados</h2>
                    <!-- Botón cerrar -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= GridView::widget([
                            'dataProvider' => $listadoPortatilesAveriados,
                            'columns' => [
                                [
                                    'attribute' => 'codigo',
                                    'label' => 'Código',
                                ],
                                [
                                    'attribute' => 'marca',
                                    'label' => 'Marca',
                                ],
                                [
                                    'attribute' => 'modelo',
                                    'label' => 'Modelo',
                                ],
                                [
                                    'attribute' => 'procesador',
                                    'label' => 'CPU',
                                ],
                                [
                                    'attribute' => 'memoria_ram',
                                    'label' => 'RAM',
                                ],
                            ],
                            'summary' => '',
                        ]); ?>
                    <?= GridView::widget(['dataProvider' => $listadoCargadoresAveriados]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-averiados-button').click(function(e) {
            // Cancela el envio a la nueva página
            e.preventDefault();
            // Muestra el id modalPortatiles
            $('#modalAveriados').modal('show');
        });
    });
</script>

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
    var almacenes = <?php echo json_encode(array_map(function ($item) {
                        return $item['almacen'];
                    }, $almacenes)); ?>;
    var capacidad = <?php echo json_encode(array_map(function ($item) {
                        return $item['capacidad'];
                    }, $almacenes)); ?>;
    var dispositivos = <?php echo json_encode(array_map(function ($item) {
                            return $item['dispositivos'];
                        }, $almacenes)); ?>;
    Chart.defaults.font.size = 16;

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
                    pointLabels: {
                        fontSize: 300 // Tamaño de la fuente de las etiquetas
                    }
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('graficoCiclos').getContext('2d');
    var nombres = <?php echo json_encode(array_column($usoCiclo, 'nombre_corto')); ?>;
    var cantidades = <?php echo json_encode(array_column($usoCiclo, 'cantidad')); ?>;

    var graficoEstado = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombres,
            datasets: [{
                label: 'Alumnos usando pórtatiles',
                backgroundColor: ['#4040ff', '#3eb489'],
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
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (context.parsed.y !== null) {
                                label += ': ' + context.parsed.y;
                            }
                            // Busca el índice del elemento actual en el arreglo "nombres"
                            var index = nombres.indexOf(context.label);
                            // Si el índice es válido, utiliza el nombre completo en lugar del nombre corto
                            if (index !== -1) {
                                label = nombres[index];
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
</script>