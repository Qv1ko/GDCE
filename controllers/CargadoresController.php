<?php

namespace app\controllers;

use app\models\Almacenes;
use Yii;
use app\models\Cargadores;
use app\models\CargadoresSearch;
use app\models\Cargan;
use app\models\Portatiles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CargadoresController implements the CRUD actions for Cargadores model.
 */
class CargadoresController extends Controller {

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
     * Lists all Cargadores models.
     *
     * @return string
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Portatiles::sincronizarPortatiles();
        Cargan::sincronizarCargan();
        Cargadores::sincronizarCargadores();

        $searchModel = new CargadoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Cargadores();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } elseif ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'El cargador se ha añadido correctamente.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Ha ocurrido un error al añadir el cargador.');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);

    }

    /**
     * Updates an existing Cargadores model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_cargador Id Cargador
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_cargador) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_cargador);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'El cargador se ha actualizado correctamente.');
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->redirect(['index']);
            } else {
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->render('update', ['model' => $model]);
            }
        }

    }

    /**
     * Deletes an existing Cargadores model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_cargador Id Cargador
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_cargador) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        foreach ($this->findModel($id_cargador)->cargan as $cargan) {
            $cargan->delete();
        }

        $this->findModel($id_cargador)->delete();

        Yii::$app->session->setFlash('success', 'El cargador se ha eliminado correctamente.');
        return $this->redirect(['index']);

    }

    /**
     * Finds the Cargadores model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_cargador Id Cargador
     * @return Cargadores the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_cargador) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Cargadores::findOne(['id_cargador' => $id_cargador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El cargador no existe');

    }

}
