<?php

namespace app\controllers;

use app\models\Cargan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarganController implements the CRUD actions for Cargan model.
 */
class CarganController extends Controller
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
     * Lists all Cargan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cargan::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_carga' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cargan model.
     * @param int $id_carga Id Carga
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_carga)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_carga),
        ]);
    }

    /**
     * Creates a new Cargan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cargan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_carga' => $model->id_carga]);
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
    public function actionUpdate($id_carga)
    {
        $model = $this->findModel($id_carga);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_carga' => $model->id_carga]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cargan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_carga Id Carga
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_carga)
    {
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
    protected function findModel($id_carga)
    {
        if (($model = Cargan::findOne(['id_carga' => $id_carga])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
