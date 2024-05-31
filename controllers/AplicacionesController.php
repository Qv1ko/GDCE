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
class AplicacionesController extends Controller {

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
     * Lists all Aplicaciones models.
     *
     * @return string
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Aplicaciones::sincronizarAplicaciones();

        $model = new Aplicaciones();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Aplicaciones::find()->where(['id_portatil' => null])->groupBy('aplicacion'),
            'pagination' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
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
    public function actionUpdate($id_aplicacion) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_aplicacion);

        if ($this->request->isPost) {
        
            $nombre = $model->aplicacion;

            if ($model->load($this->request->post())) {

                $aplicaciones = Aplicaciones::find()->where(['aplicacion' => $nombre])->andWhere(['not', ['id_portatil' => null]])->all();

                foreach ($aplicaciones as $aplicacion) {
                    $aplicacion->aplicacion = $model->aplicacion;
                    $aplicacion->save();
                }

                $model->save();

                return $this->redirect(['index']);

            }

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
    public function actionDelete($id_aplicacion) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $aplicaciones = Aplicaciones::find()->where(['aplicacion' => $this->findModel($id_aplicacion)->aplicacion])->all();

        foreach ($aplicaciones as $aplicacion) {
            $aplicacion->delete();
        }

        return $this->redirect(['index']);

    }

    /**
     * Finds the Aplicaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_aplicacion Id Aplicacion
     * @return Aplicaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_aplicacion) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Aplicaciones::findOne(['id_aplicacion' => $id_aplicacion])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('❌ La aplicación no existe');

    }

}
