<?php

namespace app\controllers;

use app\models\Cargadores;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CargadoresController implements the CRUD actions for Cargadores model.
 */
class CargadoresController extends Controller
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
     * Lists all Cargadores models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cargadores::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_cargador' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cargadores model.
     * @param int $id_cargador Id Cargador
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_cargador)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_cargador),
        ]);
    }

    /**
     * Creates a new Cargadores model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
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
    public function actionUpdate($id_cargador)
    {
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
    public function actionDelete($id_cargador)
    {
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
    protected function findModel($id_cargador)
    {
        if (($model = Cargadores::findOne(['id_cargador' => $id_cargador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
