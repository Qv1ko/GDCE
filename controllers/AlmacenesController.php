<?php

namespace app\controllers;

use Yii;
use app\models\Almacenes;
use app\models\AlmacenesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlmacenesController implements the CRUD actions for Almacenes model.
 */
class AlmacenesController extends Controller {

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
     * Lists all Almacenes models.
     *
     * @return string
     */
    public function actionIndex() {

        $searchModel = new AlmacenesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Almacenes();
    
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);

    }
    

    /**
     * Displays a single Almacenes model.
     * @param int $id_almacen Id Almacen
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_almacen) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id_almacen),
        ]);

    }

    /**
     * Creates a new Almacenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Almacenes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_almacen' => $model->id_almacen]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Almacenes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_almacen Id Almacen
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_almacen) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_almacen);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_almacen' => $model->id_almacen]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Almacenes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_almacen Id Almacen
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_almacen) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->findModel($id_almacen)->delete();

        return $this->redirect(['index']);

    }

    /**
     * Finds the Almacenes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_almacen Id Almacen
     * @return Almacenes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_almacen) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Almacenes::findOne(['id_almacen' => $id_almacen])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');

    }

}
