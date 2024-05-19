<?php

    use app\models\Alumnos;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\ActionColumn;
    use yii\grid\GridView;
    use yii\helpers\ArrayHelper;

    /** @var yii\web\View $this */
    /** @var yii\data\ActiveDataProvider $dataProvider */

    $this->title = 'Gestión de alumnos';

    $this->registerJsFile('@web/js/jquery.js', ['position' => \yii\web\View::POS_HEAD]);
    $this->registerJsFile('@web/js/alumnos.js', ['position' => \yii\web\View::POS_HEAD]);

?>

<div class="alumnos-index">

    <div class="container">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'dni',
                    'label' => 'DNI',
                ],
                [
                    'attribute' => 'nombre',
                    'label' => 'Alumno',
                    'value' => function ($model) {
                        return $model->nombre . ' ' . $model->apellidos;
                    },
                ],
                // [
                //     'attribute' => 'estado_matricula',
                //     'label' => 'Matriculación',
                //     'value' => function ($model) {
                //         if ($model->estado_matricula == "Matriculado" && $model->cursos != null && is_object($model->cursos)) {
                //             return $model->cursos->nombre;
                //         } else {
                //             return $model->estado_matricula;
                //         }
                //     },
                // ],
                // [
                //     'attribute' => 'cursan.id_curso',
                //     'label' => 'Curso',
                //     'value' => function ($model) {
                //         return ($model->cursan != null) ? 'No matriculado' : $model->cursan->id_curso;
                //     },
                // ],
                // [
                //     'attribute' => 'cursos',
                //     'label' => 'Curso',
                //     'value' => function ($model) {
                //         // Ordena los cursos por id_cursan y toma el último
                //         $curso = $model->getCursos()->orderBy(['id_cursan' => SORT_DESC])->one();
                //         // Devuelve el nombre del curso
                //         return $curso ? $curso->nombre_curso : 'Sin curso';
                //     },
                // ],
                [
                    'attribute' => 'portatil.codigo',
                    'label' => 'Portátil',
                    'value' => function ($model) {
                        return ($model->portatil == null) ? 'Sin portátil' : $model->portatil->codigo;
                    },
                ],
                [
                    'header' => 'Botones de gestión',
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Alumnos $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id_alumno' => $model->id_alumno]);
                    },
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return '';
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>Editar', $url, [
                                'class' => 'btn btn-primary editarCursoBoton update-modal',
                                'data-code' => $model->nombre . ' ' . $model->apellidos
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>Eliminar', $url, [
                                'class' => 'btn btn-danger',
                                'data-confirm' => '¿Estás seguro de que quieres borrar este alumno?',
                                'data-method' => 'post'
                            ]);
                        }
                    ]
                ],
            ],
            'summary' => '',
        ]); ?>

        <div class="row d-flex justify-content-around">
            <p>
                <?= Html::a('<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12h6" /><path d="M12 9v6" /><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" /></svg> Crear curso', [''], ['class' => 'btn btn-success', 'id' => 'crearCursoBoton']) ?>
            </p>
        </div>

    </div>

</div>
