<?php

namespace app\controllers;

use Yii;
use app\models\Alumnos;
use app\models\AlumnosSearch;
use app\models\Cursan;
use app\models\Portatiles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * AlumnosController implements the CRUD actions for Alumnos model.
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
     * Lists all Alumnos models.
     *
     * @return string
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Portatiles::sincronizarPortatiles();
        Alumnos::sincronizarAlumnos();
        Cursan::sincronizarCursan();

        $searchModel = new AlumnosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Alumnos();
        $cursoActualManana = $model->cursoManana;
        $cursoActualTarde = $model->cursoTarde;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } elseif ($this->request->isPost) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                if ($model->estado_matricula == 'Matriculado') {

                    $cursoManana = Yii::$app->request->post('cursoManana');
                    $cursoTarde = Yii::$app->request->post('cursoTarde');

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
                        $model->id_portatil = null;
                        $model->save();    
                    }

                } else {
                    $model->id_portatil = null;
                    $model->save();
                }

                Yii::$app->session->setFlash('success', 'El alumno/a se ha añadido correctamente.');
                return $this->redirect(['index']);

            } else {
                Yii::$app->session->setFlash('error', 'Ha ocurrido un error al añadir el alumno/a.');
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
            'cursoActualManana' => $cursoActualManana,
            'cursoActualTarde' => $cursoActualTarde,
        ]);

    }

    /**
     * Updates an existing Alumnos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_alumno Id Alumno
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_alumno) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_alumno);
        $cursoActualManana = $model->cursoManana;
        $cursoActualTarde = $model->cursoTarde;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if ($model->estado_matricula == 'Matriculado') {
                    $cursoManana = Yii::$app->request->post('cursoManana');
                    $cursoTarde = Yii::$app->request->post('cursoTarde');

                    if (!empty($cursoManana) || !empty($cursoTarde)) {
                        if (!empty($cursoManana)) {
                            if (!$cursoActualManana || $cursoManana != $cursoActualManana->id_curso) {
                                $modelCursa = new Cursan();
                                $modelCursa->id_curso = $cursoManana;
                                $modelCursa->id_alumno = $model->id_alumno;
                                $modelCursa->curso_academico = Cursan::getCursoActual();
                                $modelCursa->save();
                                if ($cursoActualManana) {
                                    Cursan::deleteAll(['id_curso' => $cursoActualManana->id_curso, 'id_alumno' => $model->id_alumno]);
                                }
                            }
                        } else if ($cursoActualManana) {
                            Cursan::deleteAll(['id_curso' => $cursoActualManana->id_curso, 'id_alumno' => $model->id_alumno]);
                        }

                        if (!empty($cursoTarde)) {
                            if (!$cursoActualTarde || $cursoTarde != $cursoActualTarde->id_curso) {
                                $modelCursa = new Cursan();
                                $modelCursa->id_curso = $cursoTarde;
                                $modelCursa->id_alumno = $model->id_alumno;
                                $modelCursa->curso_academico = Cursan::getCursoActual();
                                $modelCursa->save();
                                if ($cursoActualTarde) {
                                    Cursan::deleteAll(['id_curso' => $cursoActualTarde->id_curso, 'id_alumno' => $model->id_alumno]);
                                }
                            }
                        } else if ($cursoActualTarde) {
                            Cursan::deleteAll(['id_curso' => $cursoActualTarde->id_curso, 'id_alumno' => $model->id_alumno]);
                        }
                    } else {
                        $model->id_portatil = null;
                        $model->save();
                    }
                } else {
                    $model->id_portatil = null;
                    $model->save();
                }

                Yii::$app->session->setFlash('success', 'El alumno/a se ha actualizado correctamente.');
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

    public function actionReservar() {

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

        if (($cursosAlumnoManana > 1 || $cursosAlumnoTarde > 1) && $idAlumnoManana === $idAlumnoTarde) {
            Yii::$app->session->setFlash('error', 'Un alumno seleccionado necesita el portátil durante el turno de mañana y tarde.');
        } else {
            Alumnos::updateAll(['id_portatil' => $idPortatil], ['id_alumno' => [$idAlumnoManana, $idAlumnoTarde]]);    
            Yii::$app->session->setFlash('success', 'El portátil ha sido reservado correctamente.');
        }

    }

    /**
     * Deletes an existing Alumnos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_alumno Id Alumno
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_alumno) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $aplicaciones = Cursan::find()->where(['id_alumno' => $id_alumno])->all();

        foreach ($aplicaciones as $aplicacion) {
            $aplicacion->delete();
        }

        $this->findModel($id_alumno)->delete();

        Yii::$app->session->setFlash('success', 'El alumno/a se ha eliminado correctamente.');
        return $this->redirect(['index']);

    }

    /**
     * Finds the Alumnos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_alumno Id Alumno
     * @return Alumnos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_alumno) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Alumnos::findOne(['id_alumno' => $id_alumno])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El alumno/a no existe');

    }

}
