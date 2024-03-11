<?php

namespace app\controllers;

use Yii;
use app\models\Cursos;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CursosController implements the CRUD actions for Cursos model.
 */
class CursosController extends Controller
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
     * Lists all Cursos models.
     *
     * @return string
     */
    public function actionIndex()
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Cursos::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id_curso' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cursos model.
     * @param int $id_curso Id Curso
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_curso)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('view', [
            'model' => $this->findModel($id_curso),
        ]);
    }

    /**
     * Creates a new Cursos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Cursos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_curso' => $model->id_curso]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cursos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_curso Id Curso
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_curso)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_curso);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_curso' => $model->id_curso]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cursos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_curso Id Curso
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_curso)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
    protected function findModel($id_curso)
    {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Cursos::findOne(['id_curso' => $id_curso])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
