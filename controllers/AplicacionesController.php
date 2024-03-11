<?php

namespace app\controllers;

use Yii;
use app\models\Aplicaciones;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AplicacionesController implements the CRUD actions for Aplicaciones model.
 */
class AplicacionesController extends Controller
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
     * Lists all Aplicaciones models.
     *
     * @return string
     */
    public function actionIndex()
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Aplicaciones::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_aplicacion' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aplicaciones model.
     * @param int $id_aplicacion Id Aplicacion
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_aplicacion)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id_aplicacion),
        ]);
    }

    /**
     * Creates a new Aplicaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Aplicaciones();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_aplicacion' => $model->id_aplicacion]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Aplicaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_aplicacion Id Aplicacion
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_aplicacion)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_aplicacion);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_aplicacion' => $model->id_aplicacion]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Aplicaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_aplicacion Id Aplicacion
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_aplicacion)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->findModel($id_aplicacion)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aplicaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_aplicacion Id Aplicacion
     * @return Aplicaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_aplicacion)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Aplicaciones::findOne(['id_aplicacion' => $id_aplicacion])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
