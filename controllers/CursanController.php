<?php

namespace app\controllers;

use Yii;
use app\models\Cursan;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
     * Lista todas las relaciones `Cursan`.
     * 
     * @return string Renderiza la vista 'index' con la lista de relaciones.
     */
    public function actionIndex() {

        if (Yii::$app->user->isGuest) {
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
     * Crea una nueva relación `Cursan`.
     * Si la creación es exitosa, redirige a la página de índice.
     * 
     * @return string|\yii\web\Response Renderiza la vista 'create' o redirige al índice tras la creación.
     */
    public function actionCreate() {

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
     * Actualiza una relación `Cursan` existente.
     * Si la actualización es exitosa, redirige a la página de índice.
     * 
     * @param int $id_cursa Identificador de la relación.
     * @return string|\yii\web\Response Renderiza la vista 'update' o redirige al índice tras la actualización.
     * @throws NotFoundHttpException si la relación no se encuentra.
     */
    public function actionUpdate($id_cursa) {

        $model = $this->findModel($id_cursa); // Encuentra la relación `Cursan` por su ID

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Elimina una relación `Cursan` existente.
     * Si la eliminación es exitosa, redirige a la página de índice.
     * 
     * @param int $id_cursa Identificador de la relación.
     * @return \yii\web\Response Redirige a la vista 'index' tras la eliminación.
     * @throws NotFoundHttpException si la relación no se encuentra.
     */
    public function actionDelete($id_cursa) {
        $this->findModel($id_cursa)->delete(); // Encuentra y elimina la relación `Cursan` por su ID
        return $this->redirect(['index']);
    }

    /**
     * Encuentra el modelo `Cursan` basado en su clave primaria.
     * Si el modelo no se encuentra, lanza una excepción 404.
     * 
     * @param int $id_cursa Identificador de la relación.
     * @return Cursan El modelo cargado.
     * @throws NotFoundHttpException si la relación no se encuentra.
     */
    protected function findModel($id_cursa) {
        if (($model = Cursan::findOne(['id_cursa' => $id_cursa])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('No existe la relación entre el alumno y el curso');
    }

}
