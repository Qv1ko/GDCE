<?php

    /** @var yii\web\View $this */

    use yii\grid\GridView;
    use yii\helpers\Html;

    // Título de la página
    $this->title = 'Panel';

    // Registro de archivos JS necesarios
    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/chart.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="site-panel">
    <div class="container">
        <div class="row">

            <!-- Panel de portátiles disponibles -->
            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:240px;">

                    <h2>Portátiles disponibles</h2>

                    <div class="d-flex flex-column justify-content-center">
                        <!-- Número de portátiles disponibles -->
                        <p class="font-weight-bold" style="font-size: 64px; height: 80px;"><?= $portatilesDisponibles ?></p>
                        <!-- Porcentaje de portátiles disponibles -->
                        <p class="font-weight-bold" style="color: <?= $porcentajePortatilesDisponibles < 10 ? '#489FB5' : '#82C0CC' ?>;"><?= $porcentajePortatilesDisponibles ?>%</p>
                    </div>

                    <div class="d-flex justify-content-around">
                        <!-- Botón para abrir el modal de listado de portátiles -->
                        <?= Html::a('<div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list" style="margin-right: 4px;">
                                <title>Ver listado</title>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 6l11 0" />
                                <path d="M9 12l11 0" />
                                <path d="M9 18l11 0" />
                                <path d="M5 6l0 .01" />
                                <path d="M5 12l0 .01" />
                                <path d="M5 18l0 .01" />
                            </svg>
                            <span>Ver listado</span>
                        </div>', [''], ['class' => 'btn btn-primary', 'id' => 'botonModalPortatiles']) ?>
                    </div>

                </div>
            </div>

            <!-- Panel de cargadores disponibles -->
            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:240px;">

                    <h2>Cargadores disponibles</h2>

                    <div class="d-flex flex-column justify-content-center">
                        <!-- Número de cargadores disponibles -->
                        <p class="font-weight-bold" style="font-size: 64px; height: 80px;"><?= $cargadoresDisponibles ?></p>
                        <!-- Porcentaje de cargadores disponibles -->
                        <p class="font-weight-bold" style="color: <?= $porcentajeCargadoresDisponibles < 10 ? '#489FB5' :  '#82C0CC' ?>;"><?= $porcentajeCargadoresDisponibles ?>%</p>
                    </div>

                    <div class="d-flex justify-content-around">
                        <!-- Botón para abrir el modal de listado de cargadores -->
                        <?= Html::a('<div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list" style="margin-right: 4px;">
                                <title>Ver listado</title>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 6l11 0" />
                                <path d="M9 12l11 0" />
                                <path d="M9 18l11 0" />
                                <path d="M5 6l0 .01" />
                                <path d="M5 12l0 .01" />
                                <path d="M5 18l0 .01" />
                            </svg>
                            <span>Ver listado</span>
                        </div>', [''], ['class' => 'btn btn-primary', 'id' => 'botonModalCargadores']) ?>
                    </div>

                </div>
            </div>

            <!-- Panel de dispositivos averiados -->
            <div class="col-md-3">
                <div class="square d-flex flex-column justify-content-between" style="height:240px;">

                    <h2>Dispositivos averiados</h2>

                    <div>
                        <!-- Número de portátiles y cargadores averiados -->
                        <p><span class="font-weight-bold" style="font-size: 32px;"><?= $portatilesAveriados ?></span> portátiles</p>
                        <p><span class="font-weight-bold" style="font-size: 32px;"><?= $cargadoresAveriados ?></span> cargadores</p>
                    </div>

                    <div class="d-flex justify-content-around">
                        <!-- Botón para abrir el modal de dispositivos averiados -->
                        <?= Html::a('<div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list" style="margin-right: 4px;">
                                <title>Ver listado</title>
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 6l11 0" />
                                <path d="M9 12l11 0" />
                                <path d="M9 18l11 0" />
                                <path d="M5 6l0 .01" />
                                <path d="M5 12l0 .01" />
                                <path d="M5 18l0 .01" />
                            </svg>
                            <span>Ver listado</span>
                        </div>', [''], ['class' => 'btn btn-primary', 'id' => 'botonModalAveriados']) ?>
                    </div>

                </div>
            </div>
            <!-- Panel para el gráfico del estado de los dispositivos -->
            <div class="col-md-3">
                <div class="square" style="height:240px;">
                    <canvas id="graficoEstado"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Panel para el gráfico de capacidad de los almacenes -->
            <div class="col-md-6">
                <div class="square">
                    <canvas id="graficoAlmacenes" style="height: 400px;"></canvas>
                </div>
            </div>
            <!-- Panel para el gráfico de uso por ciclo formativo -->
            <div class="col-md-6">
                <div class="square">
                    <canvas id="graficoCiclos" style="height: 400px;"></canvas>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Modal de la lista de portátiles disponibles -->
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
                    <!-- GridView para mostrar el listado de portátiles disponibles -->
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $listadoPortatilesDisponibles,
                            'columns' => [
                                [
                                    'label' => 'Portátil',
                                    'value' => function ($model) {
                                        return 'Portátil ' . $model->codigo;
                                    },
                                    'headerOptions' => ['style' => 'color: #489FB5;'],
                                    'contentOptions' => function ($model, $key, $index, $column) {
                                        return [
                                            'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                        ];
                                    },
                                ],
                                [
                                    'label' => 'Almacén',
                                    'value' => function ($model) {
                                        return empty($model->almacen->id_almacen)? 'Sin almacén' : 'Almacén ' . $model->almacen->aula;
                                    },
                                    'headerOptions' => ['style' => 'color: #489FB5;'],
                                    'contentOptions' => function ($model, $key, $index, $column) {
                                        return [
                                            'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                        ];
                                    },
                                ],
                            ],
                            'summary' => '',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mostrar modal cuando se haga clic en el botón -->
<script>
    $(document).ready(function() {
        $('#botonModalPortatiles').click(function(e) {
            e.preventDefault();
            $('#modalPortatiles').modal('show');
        });
    });
</script>

<!-- Modal de la lista de cargadores disponibles -->
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
                    <!-- GridView para mostrar el listado de cargadores disponibles -->
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $listadoCargadoresDisponibles,
                            'columns' => [
                                [
                                    'label' => 'Cargador',
                                    'value' => function ($model) {
                                        return 'Cargador ' . $model->codigo;
                                    },
                                    'headerOptions' => ['style' => 'color: #489FB5;'],
                                    'contentOptions' => function ($model, $key, $index, $column) {
                                        return [
                                            'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                        ];
                                    },
                                ],
                                [
                                    'label' => 'Almacén',
                                    'value' => function ($model) {
                                        return empty($model->almacen->id_almacen)? 'Sin almacén' : 'Almacén ' . $model->almacen->aula;
                                    },
                                    'headerOptions' => ['style' => 'color: #489FB5;'],
                                    'contentOptions' => function ($model, $key, $index, $column) {
                                        return [
                                            'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                        ];
                                    },
                                ],
                            ],
                            'summary' => '',
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mostrar modal cuando se haga clic en el botón -->
<script>
    $(document).ready(function() {
        $('#botonModalCargadores').click(function(e) {
            e.preventDefault();
            $('#modalCargadores').modal('show');
        });
    });
</script>

<!-- Modal de la lista de dispositivos averiados -->
<div class="container">
    <div class="modal fade" id="modalAveriados" tabindex="-1" role="dialog" aria-labelledby="modalAveriadosLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Dispositivos averiados</h2>
                    <!-- Botón cerrar -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="table-responsive">
                                <!-- GridViews para mostrar el listado de dispositivos averiados -->
                                <?= GridView::widget([
                                    'dataProvider' => $listadoPortatilesAveriados,
                                    'columns' => [
                                        [
                                            'label' => 'Portátil',
                                            'value' => function ($model) {
                                                return 'Portátil ' . $model->codigo;
                                            },
                                            'headerOptions' => ['style' => 'color: #489FB5;'],
                                            'contentOptions' => function ($model, $key, $index, $column) {
                                                return [
                                                    'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                                ];
                                            },
                                        ],
                                        [
                                            'label' => 'Módelo',
                                            'value' => function ($model) {
                                                return empty($model->marca)? 'Sin definir' : $model->marca . ' ' . $model->modelo;
                                            },
                                            'headerOptions' => ['style' => 'color: #489FB5;'],
                                            'contentOptions' => function ($model, $key, $index, $column) {
                                                return [
                                                    'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                                ];
                                            },
                                        ],
                                        [
                                            'label' => 'Almacén',
                                            'value' => function ($model) {
                                                return empty($model->almacen->id_almacen)? 'Sin almacén' : 'Almacén ' . $model->almacen->aula;
                                            },
                                            'headerOptions' => ['style' => 'color: #489FB5;'],
                                            'contentOptions' => function ($model, $key, $index, $column) {
                                                return [
                                                    'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                                ];
                                            },
                                        ]
                                    ],
                                    'summary' => '',
                                ]); ?>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="table-responsive">
                                <?= GridView::widget([
                                    'dataProvider' => $listadoCargadoresAveriados,
                                    'columns' => [
                                        [
                                            'label' => 'Cargador',
                                            'value' => function ($model) {
                                                return 'Cargador ' . $model->codigo;
                                            },
                                            'headerOptions' => ['style' => 'color: #489FB5;'],
                                            'contentOptions' => function ($model, $key, $index, $column) {
                                                return [
                                                    'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                                ];
                                            },
                                        ],
                                        [
                                            'label' => 'Almacén',
                                            'value' => function ($model) {
                                                return empty($model->almacen)? 'Sin almacén' : 'Almacén ' . $model->almacen->aula;
                                            },
                                            'headerOptions' => ['style' => 'color: #489FB5;'],
                                            'contentOptions' => function ($model, $key, $index, $column) {
                                                return [
                                                    'style' => 'vertical-align: middle; background-color: ' . ($index % 2 === 0 ? '#82C0CC32' : '#FFFFFF32') . ';',
                                                ];
                                            },
                                        ],
                                    ],
                                    'summary' => '',
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mostrar modal cuando se haga clic en el botón -->
<script>
    $(document).ready(function() {
        $('#botonModalAveriados').click(function(e) {
            e.preventDefault();
            $('#modalAveriados').modal('show');
        });
    });
</script>

<script>

    // Configuración del gráfico de estado
    var ctx = document.getElementById('graficoEstado').getContext('2d');
    var graphData = [<?= $portatilesDisponibles ?>, <?= $cargadoresDisponibles ?>, <?= $portatilesNoDisponibles ?>, <?= $cargadoresNoDisponibles ?>, <?= $portatilesAveriados ?>, <?= $cargadoresAveriados ?>];
    var color = ['#82C0CC', '#82C0CC', '#489FB5', '#489FB5', '#16697A', '#16697A'];
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
                },
                tooltip: {
                    titleFont: {
                        size: 16,
                        family: 'Roboto'
                    },
                    bodyFont: {
                        size: 14,
                        family: 'Roboto'
                    }
                }
            }
        }
    });

    // Configuración del gráfico de capacidad de los almacenes
    var ctx = document.getElementById('graficoAlmacenes').getContext('2d');
    var almacenes = <?php echo json_encode(array_map(function ($item) {return $item['almacen'];}, $almacenes)); ?>;
    var capacidad = <?php echo json_encode(array_map(function ($item) {return $item['capacidad'];}, $almacenes)); ?>;
    var dispositivos = <?php echo json_encode(array_map(function ($item) {return $item['dispositivos'];}, $almacenes)); ?>;
    var graficoAlmacenes = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: almacenes,
            datasets: [{
                label: 'Capacidad máxima',
                data: capacidad,
                backgroundColor: '#489FB516',
                borderColor: '#489FB5',
                pointBackgroundColor: '#489FB5',
                pointBorderColor: '#E3E3E3',
                pointHoverBackgroundColor: '#E3E3E3',
                pointHoverBorderColor: '#489FB5'
            }, {
                label: 'Capacidad ocupada actual',
                data: dispositivos,
                backgroundColor: '#82C0CC32',
                borderColor: '#82C0CC',
                pointBackgroundColor: '#82C0CC',
                pointBorderColor: '#E3E3E3',
                pointHoverBackgroundColor: '#E3E3E3',
                pointHoverBorderColor: '#82C0CC'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Capacidad total y actual por almacén',
                    color: '#16697A',
                    font: {
                        size: 18,
                        family: 'Roboto',
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
                        size: 16,
                        family: 'Roboto'
                    },
                    bodyFont: {
                        size: 14,
                        family: 'Roboto'
                    }
                }
            },
            scales: {
                r: {
                    beginAtZero: true,
                    suggestedMax: Math.max(...capacidad) + 5,
                    pointLabels: {
                        font: {
                            size: 14,
                            family: 'Roboto'
                        }
                    }
                }
            }
        }
    });

    // Configuración del gráfico de uso por ciclo
    var ctx = document.getElementById('graficoCiclos').getContext('2d');
    var nombres = <?php echo json_encode(array_column($usoCiclo, 'sigla')); ?>;
    var cantidades = <?php echo json_encode(array_column($usoCiclo, 'cantidad')); ?>;
    var graficoEstado = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: nombres,
            datasets: [{
                label: 'Alumnos usando portátiles',
                backgroundColor: ['#489FB5', '#82C0CC'],
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
                    color: '#16697A',
                    font: {
                        size: 18,
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
                        size: 16,
                        family: 'Roboto'
                    },
                    bodyFont: {
                        size: 14,
                        family: 'Roboto'
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
                x: {
                    ticks: {
                        maxTicksLimit: 8,
                    },
                }
            }
        }
    });

</script>
