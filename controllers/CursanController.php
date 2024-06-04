<?php

namespace app\controllers;

use Yii;
use app\models\Cursan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CursanController implements the CRUD actions for Cursan model.
 */
class CursanController extends Controller {

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
     * Lists all Cursan models.
     *
     * @return string
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Cursan::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Creates a new Cursan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Cursan();

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
     * Updates an existing Cursan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_cursa Id Cursa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_cursa) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_cursa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Cursan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_cursa Id Cursa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_cursa) {

        $this->findModel($id_cursa)->delete();

        return $this->redirect(['index']);

    }

    /**
     * Finds the Cursan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_cursa Id Cursa
     * @return Cursan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_cursa) {

        if (($model = Cursan::findOne(['id_cursa' => $id_cursa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('No existe la relación entre el alumno y el curso');

    }

}
