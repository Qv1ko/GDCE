<?php

namespace app\controllers;

use app\models\Almacenes;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AlmacenesController implements the CRUD actions for Almacenes model.
 */
class AlmacenesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
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
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Almacenes::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_almacen' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Almacenes model.
     * @param int $id_almacen Id Almacen
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_almacen)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_almacen),
        ]);
    }

    /**
     * Creates a new Almacenes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
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
    public function actionUpdate($id_almacen)
    {
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
    public function actionDelete($id_almacen)
    {
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
    protected function findModel($id_almacen)
    {
        if (($model = Almacenes::findOne(['id_almacen' => $id_almacen])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
