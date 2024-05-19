<?php

namespace app\controllers;

use Yii;
use app\models\Cargadores;
use app\models\CargadoresSearch;
use app\models\Cargan;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        Cargadores::sincronizarCargadores();
        Cargan::sincronizarCargan();

        $searchModel = new CargadoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Cargadores();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);

    }

    /**
     * Displays a single Cargadores model.
     * @param int $id_cargador Id Cargador
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_cargador) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id_cargador),
        ]);

    }

    /**
     * Creates a new Cargadores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Cargadores();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_cargador' => $model->id_cargador]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_cargador' => $model->id_cargador]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

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

        $this->findModel($id_cargador)->delete();

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

        throw new NotFoundHttpException('The requested page does not exist.');

    }

}
