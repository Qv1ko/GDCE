<?php

namespace app\controllers;

use Yii;
use app\models\Portatiles;
use app\models\PortatilesSearch;
use app\models\Aplicaciones;
use app\models\Alumnos;
use app\models\Cargan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PortatilesController implements the CRUD actions for Portatiles model.
 */
class PortatilesController extends Controller {
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
     * Lists all Portatiles models.
     *
     * @return string
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Portatiles::sincronizarPortatiles();
        Aplicaciones::sincronizarAplicaciones();
        Cargan::sincronizarCargan();

        $searchModel = new PortatilesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Portatiles();
        $aplicacionesInstaladas = array_map(function($app) {
            return $app->aplicacion;
        }, $model->aplicaciones);
        $cargadorActual = $model->cargador;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                $aplicacionesSeleccionadas = Yii::$app->request->post('aplicaciones');

                if (is_array($aplicacionesSeleccionadas)) {
                    foreach ($aplicacionesSeleccionadas as $aplicacion) {
                        $aplicacionModel = new Aplicaciones();
                        $aplicacionModel->aplicacion = $aplicacion;
                        $aplicacionModel->id_portatil = $model->id_portatil;
                        $aplicacionModel->save();
                    }
                }

                if ($model->estado !== 'Averiado') {
                    $cargador = Yii::$app->request->post('cargador');
    
                    if ($cargador) {
                        $carganModel = new Cargan();
                        $carganModel->id_portatil = $model->id_portatil;
                        $carganModel->id_cargador = $cargador;
                        $carganModel->save();
                    }
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
            'aplicacionesInstaladas' => $aplicacionesInstaladas,
            'cargador' => $cargadorActual,
        ]);

    }

    /**
     * Updates an existing Portatiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_portatil Id Portatil
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_portatil) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_portatil);
        $aplicacionesInstaladas = array_map(function($app) {
            return $app->aplicacion;
        }, $model->aplicaciones);
        $aplicacionesActuales = $model->aplicaciones;
        $cargadorActual = $model->cargador;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                $aplicacionesSeleccionadas = Yii::$app->request->post('aplicaciones');

                if (is_array($aplicacionesSeleccionadas)) {

                    foreach ($aplicacionesSeleccionadas as $aplicacion) {
                        if (!in_array($aplicacion, $aplicacionesActuales)) {
                            $aplicacionModel = new Aplicaciones();
                            $aplicacionModel->aplicacion = $aplicacion;
                            $aplicacionModel->id_portatil = $model->id_portatil;
                            $aplicacionModel->save();
                        }
                    }

                    foreach ($aplicacionesActuales as $app) {
    
                        $aplicacionModel = Aplicaciones::findOne(['aplicacion' => $app->aplicacion, 'id_portatil' => $model->id_portatil]);
    
                        if ($aplicacionModel !== null && !in_array($aplicacionModel->aplicacion, $aplicacionesSeleccionadas)) {
                            $aplicacionModel->delete();
                        }

                    }

                }

                if ($model->estado !== 'Averiado') {

                    $cargador = Yii::$app->request->post('cargador');
                
                    if (!empty($cargador)) {
                        if (($cargadorActual) ? $cargador != $cargadorActual->id_cargador : true) {
                            $carganModel = new Cargan();
                            $carganModel->id_portatil = $model->id_portatil;
                            $carganModel->id_cargador = $cargador;
                            $carganModel->save();
                            if ($cargadorActual) {
                                Cargan::find()->where(['id_cargador' => $cargadorActual->id_cargador])->andWhere(['id_portatil' => $model->id_portatil])->one()->delete();
                            }
                        }
                    } else if ($cargadorActual) {
                        Cargan::find()->where(['id_cargador' => $cargadorActual->id_cargador])->andWhere(['id_portatil' => $model->id_portatil])->one()->delete();
                    }

                } else if ($cargadorActual) {
                    Cargan::find()->where(['id_cargador' => $cargadorActual->id_cargador])->andWhere(['id_portatil' => $model->id_portatil])->one()->delete();
                }

                Yii::$app->session->setFlash('success', 'El portátil se ha actualizado correctamente.');
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', [
                    'model' => $model,
                    'aplicacionesInstaladas' => $aplicacionesInstaladas,
                    'cargador' => $cargadorActual,
                ]) : $this->redirect(['index']);

            } else {
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', [
                    'model' => $model,
                    'aplicacionesInstaladas' => $aplicacionesInstaladas,
                    'cargador' => $cargadorActual,
                ]) : $this->render('update', [
                    'model' => $model,
                    'aplicacionesInstaladas' => $aplicacionesInstaladas,
                    'cargador' => $cargadorActual,
                ]);
            }
        }

    }

    /**
     * Deletes an existing Portatiles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_portatil Id Portatil
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_portatil) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $aplicaciones = Aplicaciones::find()->where(['id_portatil' => $id_portatil])->all();

        foreach ($aplicaciones as $aplicacion) {
            $aplicacion->delete();
        }

        $cargas = Cargan::find()->where(['id_portatil' => $id_portatil])->all();

        foreach ($cargas as $carga) {
            $carga->delete();
        }

        $alumnos = Alumnos::find()->where(['id_portatil' => $id_portatil])->all();

        foreach ($alumnos as $alumno) {
            $alumno->id_portatil = null;
            $alumno->save();
        }

        $this->findModel($id_portatil)->delete();

        return $this->redirect(['index']);

    }

    public function actionAplicaciones($id) {
        $model = Portatiles::findOne($id);
        return $this->renderAjax('_aplicaciones', ['model' => $model]);
    }

    /**
     * Finds the Portatiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_portatil Id Portatil
     * @return Portatiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_portatil) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Portatiles::findOne(['id_portatil' => $id_portatil])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El portátil no existe');

    }

}
