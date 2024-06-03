<?php

namespace app\controllers;

use Yii;
use app\models\Cursos;
use app\models\CursosSearch;
use app\models\Cursan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CursosController implements the CRUD actions for Cursos model.
 */
class CursosController extends Controller {

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
     * Lists all Cursos models.
     *
     * @return string
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new CursosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Cursos();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } elseif ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Cursos::setSigla($model);
                Yii::$app->session->setFlash('success', 'El curso se ha añadido correctamente.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Ha ocurrido un error al añadir el curso.');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);

    }

    /**
     * Updates an existing Cursos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_curso Id Curso
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id_curso) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_curso);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Cursos::setSigla($model);
                Yii::$app->session->setFlash('success', 'El curso se ha actualizado correctamente.');
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->redirect(['index']);
            } else {
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->render('update', ['model' => $model]);
            }
        }

    }

    /**
     * Deletes an existing Cursos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_curso Id Curso
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_curso) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Cursan::find(['id_curso' => $id_curso])->delete();
        $this->findModel($id_curso)->delete();

        return $this->redirect(['index']);

    }

    /**
     * Finds the Cursos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_curso Id Curso
     * @return Cursos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_curso) {

        if (($model = Cursos::findOne(['id_curso' => $id_curso])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');

    }

}
