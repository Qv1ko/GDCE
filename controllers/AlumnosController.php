<?php

namespace app\controllers;

use Yii;
use app\models\Alumnos;
use app\models\AlumnosSearch;
use app\models\Cursan;
use yii\data\ActiveDataProvider;
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

        Alumnos::sincronizarAlumnos();
        Cursan::sincronizarCursan();

        $searchModel = new AlumnosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Alumnos();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);

    }

    /**
     * Displays a single Alumnos model.
     * @param int $id_alumno Id Alumno
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_alumno) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id_alumno),
        ]);

    }

    /**
     * Creates a new Alumnos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Alumnos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_alumno' => $model->id_alumno]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_alumno' => $model->id_alumno]);
        }

        return $this->render('update', [
            'model' => $model,
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

        throw new NotFoundHttpException('The requested page does not exist.');

    }

}
