<?php

namespace app\controllers;

use Yii;
use app\models\Cargan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarganController implements the CRUD actions for Cargan model.
 */
class CarganController extends Controller {

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
     * Lists all Cargan models.
     *
     * @return string
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Cargan::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Creates a new Cargan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Cargan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Cargan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_carga Id Carga
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_carga) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_carga);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }
    
    public function actionVincular() {

        $cargador = Yii::$app->request->post('cargador');
        $portatil = Yii::$app->request->post('portatil');


        if ($cargador !== null && $portatil !== null) {

            $antiguasCargas = Cargan::find()->where(['id_cargador' => $cargador])->orWhere(['id_portatil' => $portatil])->all();
    
            foreach ($antiguasCargas as $carga) {
                $carga->delete();
            }
    
            $model = new Cargan();
            $model->id_cargador = $cargador;
            $model->id_portatil = $portatil;
            $model->save();

            Yii::$app->session->setFlash('success', 'El cargador se ha vinculado correctamente.');

        } elseif ($cargador !== null && $portatil === null) {

            $antiguasCargas = Cargan::find()->where(['id_cargador' => $cargador])->all();
    
            foreach ($antiguasCargas as $carga) {
                $carga->delete();
            }

        }

    }

    /**
     * Deletes an existing Cargan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_carga Id Carga
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_carga) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->findModel($id_carga)->delete();

        return $this->redirect(['index']);

    }

    /**
     * Finds the Cargan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_carga Id Carga
     * @return Cargan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_carga) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Cargan::findOne(['id_carga' => $id_carga])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('No existe la relación entre el cargador y el portátil');

    }

}
