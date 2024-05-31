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

        if ($this->request->isPost) {
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

                return $this->redirect(['index']);

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model,
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

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post()) && $model->save()) {

                if ($model->estado_matricula == 'Matriculado') {

                    $cursoManana = Yii::$app->request->post('cursoManana');
                    $cursoTarde = Yii::$app->request->post('cursoTarde');

                    if (!empty($cursoManana) || !empty($cursoTarde)) {

                        if (!empty($cursoManana)) {
                            if (($cursoActualManana) ? $cursoManana != $cursoActualManana->id_curso : true) {
                                $modelCursa = new Cursan();
                                $modelCursa->id_curso = $cursoManana;
                                $modelCursa->id_alumno = $model->id_alumno;
                                $modelCursa->curso_academico = Cursan::getCursoActual();
                                $modelCursa->save();
                                if ($cursoActualManana) {
                                    Cursan::find()->where(['id_curso' => $cursoActualManana->id_curso])->andWhere(['id_alumno' => $model->id_alumno])->one()->delete();
                                }
                            }
                        } else if ($cursoActualManana) {
                            Cursan::find()->where(['id_curso' => $cursoActualManana->id_curso])->andWhere(['id_alumno' => $model->id_alumno])->one()->delete();
                        }

                        if (!empty($cursoTarde)) {
                            if (($cursoActualTarde) ? $cursoTarde != $cursoActualTarde->id_curso : true) {
                                $modelCursa = new Cursan();
                                $modelCursa->id_curso = $cursoTarde;
                                $modelCursa->id_alumno = $model->id_alumno;
                                $modelCursa->curso_academico = Cursan::getCursoActual();
                                $modelCursa->save();
                                if ($cursoActualTarde) {
                                    Cursan::find()->where(['id_curso' => $cursoActualTarde->id_curso])->andWhere(['id_alumno' => $model->id_alumno])->one()->delete();
                                }
                            }
                        } else if ($cursoActualTarde) {
                            Cursan::find()->where(['id_curso' => $cursoActualTarde->id_curso])->andWhere(['id_alumno' => $model->id_alumno])->one()->delete();
                        }

                    } else {
                        $model->id_portatil = null;
                        $model->save();    
                    }

                } else {
                    $model->id_portatil = null;
                    $model->save();
                }


                return $this->redirect(['index']);

            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
            'cursoActualManana' => $cursoActualManana,
            'cursoActualTarde' => $cursoActualTarde,
        ]);

    }

    public function actionReservar() {

        $idPortatil = Yii::$app->request->post('portatil');
        $idAlumnoManana = Yii::$app->request->post('alumnoManana');
        $idAlumnoTarde = Yii::$app->request->post('alumnoTarde');

        Alumnos::updateAll(['id_portatil' => $idPortatil], ['id_alumno' => [$idAlumnoManana, $idAlumnoTarde]]);

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

        throw new NotFoundHttpException('❌ El alumno/a no existe');

    }

}
