<?php

namespace app\controllers;

use Yii;
use app\models\Portatiles;
use app\models\Cargan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        Cargan::sincronizarCargan();

        $dataProvider = new ActiveDataProvider([
            'query' => Portatiles::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_portatil' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single Portatiles model.
     * @param int $id_portatil Id Portatil
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_portatil) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id_portatil),
        ]);

    }

    /**
     * Creates a new Portatiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Portatiles();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_portatil' => $model->id_portatil]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_portatil' => $model->id_portatil]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

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

        $this->findModel($id_portatil)->delete();

        return $this->redirect(['index']);

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

        throw new NotFoundHttpException('The requested page does not exist.');

    }

}
