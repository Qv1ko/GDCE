<?php

namespace app\controllers;

use Yii;
use app\models\Alumnos;
use app\models\AlumnosSearch;
use app\models\Cursan;
use app\models\Portatiles;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * AlumnosController implementa las acciones CRUD para el modelo Alumnos.
 */
class AlumnosController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Muestra todos los modelos Alumnos.
     *
     * @return string La vista 'index'.
     */
    public function actionIndex() {

        // Si el usuario no está autenticado, redirige a la página principal.
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // Sincroniza las tablas relacionadas.
        Portatiles::sincronizarPortatiles();
        Cursan::sincronizarCursan();
        Alumnos::sincronizarAlumnos();

        // Inicializa el modelo de búsqueda y el proveedor de datos.
        $searchModel = new AlumnosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Alumnos();
        $cursoActualManana = $model->cursoManana;
        $cursoActualTarde = $model->cursoTarde;

        // Maneja las validaciones AJAX.
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } elseif ($this->request->isPost) {
            // Procesa la solicitud POST para crear un nuevo alumno.
            if ($model->load($this->request->post()) && $model->save()) {

                // Verifica si el alumno está matriculado.
                if ($model->estado_matricula == 'Matriculado') {

                    // Obtiene los cursos de la mañana y tarde.
                    $cursoManana = Yii::$app->request->post('cursoManana');
                    $cursoTarde = Yii::$app->request->post('cursoTarde');

                    // Asigna los cursos al alumno si están disponibles.
                    if (!empty($cursoManana) || !empty($cursoTarde)) {
                        $cursos = [$cursoManana, $cursoTarde];

                        foreach ($cursos as $curso) {
                            if (!empty($curso)) {
                                $modelCursa = new Cursan();
                                $modelCursa->id_curso = $curso;
                                $modelCursa->id_alumno = $model->id_alumno;
                                $modelCursa->curso_academico = Cursan::getCursoActual();
                                $modelCursa->save();
                            }
                        }
                    } else {
                        $model->id_portatil = null; // Elimina la relación con el portátil si no hay cursos.
                        $model->save();    
                    }
                } else {
                    $model->id_portatil = null; // Elimina la relación con el portátil si no está matriculado.
                    $model->save();
                }

                Yii::$app->session->setFlash('success', 'El alumno/a se ha añadido correctamente.');
                return $this->redirect(['index']); // Redirige a la vista 'index' tras el éxito.
            } else {
                Yii::$app->session->setFlash('error', 'Ha ocurrido un error al añadir el alumno/a.');
            }
        } else {
            $model->loadDefaultValues(); // Carga los valores por defecto.
        }

        // Renderiza la vista 'index' con los datos.
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
            'cursoActualManana' => $cursoActualManana,
            'cursoActualTarde' => $cursoActualTarde,
        ]);
    }

    /**
     * Actualiza un modelo Alumnos existente.
     * Si la actualización es exitosa, redirige a la página 'view'.
     * @param int $id_alumno Id del Alumno.
     * @return string|\yii\web\Response La vista 'update' o redirección.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    public function actionUpdate($id_alumno) {

        $model = $this->findModel($id_alumno);
        $cursoActualManana = $model->cursoManana;
        $cursoActualTarde = $model->cursoTarde;

        // Maneja las validaciones AJAX.
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            // Procesa la solicitud POST para actualizar el alumno.
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                // Verifica si el alumno está matriculado.
                if ($model->estado_matricula == 'Matriculado') {
                    $cursoManana = Yii::$app->request->post('cursoManana');
                    $cursoTarde = Yii::$app->request->post('cursoTarde');

                    // Actualiza la relación de cursos del alumno.
                    if (!empty($cursoManana) || !empty($cursoTarde)) {
                        if (!empty($cursoManana)) {
                            // Asigna nuevo curso de mañana si es diferente al actual.
                            if (!$cursoActualManana || $cursoManana != $cursoActualManana->id_curso) {
                                $modelCursa = new Cursan();
                                $modelCursa->id_curso = $cursoManana;
                                $modelCursa->id_alumno = $model->id_alumno;
                                $modelCursa->curso_academico = Cursan::getCursoActual();
                                $modelCursa->save();
                                // Elimina la relación con el curso anterior.
                                if ($cursoActualManana) {
                                    Cursan::deleteAll(['id_curso' => $cursoActualManana->id_curso, 'id_alumno' => $model->id_alumno]);
                                }
                            }
                        } else if ($cursoActualManana) {
                            // Elimina la relación con el curso de la mañana si está vacío.
                            Cursan::deleteAll(['id_curso' => $cursoActualManana->id_curso, 'id_alumno' => $model->id_alumno]);
                        }

                        if (!empty($cursoTarde)) {
                            // Asigna nuevo curso de tarde si es diferente al actual.
                            if (!$cursoActualTarde || $cursoTarde != $cursoActualTarde->id_curso) {
                                $modelCursa = new Cursan();
                                $modelCursa->id_curso = $cursoTarde;
                                $modelCursa->id_alumno = $model->id_alumno;
                                $modelCursa->curso_academico = Cursan::getCursoActual();
                                $modelCursa->save();
                                // Elimina la relación con el curso anterior.
                                if ($cursoActualTarde) {
                                    Cursan::deleteAll(['id_curso' => $cursoActualTarde->id_curso, 'id_alumno' => $model->id_alumno]);
                                }
                            }
                        } else if ($cursoActualTarde) {
                            // Elimina la relación con el curso de la tarde si está vacío.
                            Cursan::deleteAll(['id_curso' => $cursoActualTarde->id_curso, 'id_alumno' => $model->id_alumno]);
                        }
                    } else {
                        $model->id_portatil = null; // Elimina la relación con el portátil si no hay cursos.
                        $model->save();
                    }
                } else {
                    $model->id_portatil = null; // Elimina la relación con el portátil si no está matriculado.
                    $model->save();
                }

                Yii::$app->session->setFlash('success', 'El alumno/a se ha actualizado correctamente.');
                // Renderiza la vista 'update' en AJAX o redirige a 'index'.
                if (Yii::$app->request->isAjax) {
                    return $this->renderAjax('update', [
                        'model' => $model,
                        'cursoActualManana' => $cursoActualManana,
                        'cursoActualTarde' => $cursoActualTarde,
                    ]);
                } else {
                    return $this->redirect(['index']);
                }
            } else {
                // Renderiza la vista 'update' en AJAX o la vista normal.
                if (Yii::$app->request->isAjax) {
                    return $this->renderAjax('update', [
                        'model' => $model,
                        'cursoActualManana' => $cursoActualManana,
                        'cursoActualTarde' => $cursoActualTarde,
                    ]);
                } else {
                    return $this->render('update', [
                        'model' => $model,
                        'cursoActualManana' => $cursoActualManana,
                        'cursoActualTarde' => $cursoActualTarde,
                    ]);
                }
            }
        }
    }

    /**
     * Reserva un portátil para un alumno.
     * No retorna nada y no redirige a ninguna vista.
     */
    public function actionReservar() {

        // Obtiene los datos del portátil y los alumnos de la solicitud POST.
        $idPortatil = Yii::$app->request->post('portatil');
        $idAlumnoManana = Yii::$app->request->post('alumnoManana');
        if ($idAlumnoManana == null) {
            $cursosAlumnoManana = 0;
        } else {
            $alumnoManana = $this->findModel($idAlumnoManana);
            $cursosAlumnoManana = count($alumnoManana->cursos);
        }
        $idAlumnoTarde = Yii::$app->request->post('alumnoTarde');
        if ($idAlumnoTarde == null) {
            $cursosAlumnoTarde = 0;
        } else {
            $alumnoTarde = $this->findModel($idAlumnoTarde);
            $cursosAlumnoTarde = count($alumnoTarde->cursos);
        }

        // Verifica si el mismo alumno necesita el portátil en ambos turnos.
        if (($cursosAlumnoManana > 1 || $cursosAlumnoTarde > 1) && $idAlumnoManana === $idAlumnoTarde) {
            Yii::$app->session->setFlash('error', 'Un alumno seleccionado necesita el portátil durante el turno de mañana y tarde.');
        } else {
            // Actualiza la relación de portátil con los alumnos.
            Alumnos::updateAll(['id_portatil' => $idPortatil], ['id_alumno' => [$idAlumnoManana, $idAlumnoTarde]]);    
            Yii::$app->session->setFlash('success', 'El portátil ha sido reservado correctamente.');
        }
    }

    /**
     * Elimina un modelo Alumnos existente.
     * Si la eliminación es exitosa, redirige a la página 'index'.
     * @param int $id_alumno Id del Alumno.
     * @return \yii\web\Response Redirección a 'index'.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    public function actionDelete($id_alumno) {

        // Encuentra y elimina todas las relaciones del alumno con cursos
        $aplicaciones = Cursan::find()->where(['id_alumno' => $id_alumno])->all();

        foreach ($aplicaciones as $aplicacion) {
            $aplicacion->delete();
        }

        // Elimina el alumno
        $this->findModel($id_alumno)->delete();

        Yii::$app->session->setFlash('success', 'El alumno/a se ha eliminado correctamente.');
        return $this->redirect(['index']);

    }

    /**
     * Encuentra el modelo Alumnos basado en su clave primaria.
     * Si el modelo no se encuentra, lanza una excepción 404.
     * @param int $id_alumno Id del Alumno.
     * @return Alumnos El modelo cargado.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    protected function findModel($id_alumno) {
        // Busca el modelo por su ID
        if (($model = Alumnos::findOne(['id_alumno' => $id_alumno])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('El alumno/a no existe');
    }

}
