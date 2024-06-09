<?php

namespace app\controllers;

use Yii;
use app\models\Cargan;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CarganController implements the CRUD actions for Cargan model.
 */
class CarganController extends Controller {

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
     * Lista todos los modelos de Cargan.
     *
     * @return string
     */
    public function actionIndex() {

        // Redirige a la página principal si el usuario no está autenticado
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Cargan::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Crea un nuevo modelo de Cargan.
     * Si la creación es exitosa, redirige a la página index.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {

        // Redirige a la página principal si el usuario no está autenticado
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Cargan();

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
     * Actualiza un modelo existente de Cargan.
     * Si la actualización es exitosa, redirige a la página 'index'.
     * @param int $id_carga Id Carga
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException si el modelo no se puede encontrar
     */
    public function actionUpdate($id_carga) {

        // Redirige a la página principal si el usuario no está autenticado
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_carga);

        // Maneja el envío del formulario
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        // Renderiza la vista 'update' con el modelo
        return $this->render('update', [
            'model' => $model,
        ]);

    }
    
    /**
     * Vincula un cargador a un portátil.
     * @return void
     */
    public function actionVincular() {

        $cargador = Yii::$app->request->post('cargador');
        $portatil = Yii::$app->request->post('portatil');

        if ($cargador !== null && $portatil !== null) {

            // Elimina las relaciones antiguas
            $antiguasCargas = Cargan::find()->where(['id_cargador' => $cargador])->orWhere(['id_portatil' => $portatil])->all();
    
            foreach ($antiguasCargas as $carga) {
                $carga->delete();
            }
    
            // Crea una nueva relación
            $model = new Cargan();
            $model->id_cargador = $cargador;
            $model->id_portatil = $portatil;
            $model->save();

            Yii::$app->session->setFlash('success', 'El cargador se ha vinculado correctamente.');

        } elseif ($cargador !== null && $portatil === null) {

            // Elimina las relaciones antiguas del cargador
            $antiguasCargas = Cargan::find()->where(['id_cargador' => $cargador])->all();
    
            foreach ($antiguasCargas as $carga) {
                $carga->delete();
            }

        }

    }

    /**
     * Elimina un modelo existente de Cargan.
     * Si la eliminación es exitosa, redirige a la página index.
     * @param int $id_carga Id Carga
     * @return \yii\web\Response
     * @throws NotFoundHttpException si el modelo no se puede encontrar
     */
    public function actionDelete($id_carga) {

        // Redirige a la página principal si el usuario no está autenticado
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->findModel($id_carga)->delete();

        return $this->redirect(['index']);

    }

    /**
     * Encuentra el modelo Cargan basado en su clave primaria.
     * Si el modelo no se encuentra, se lanza una excepción HTTP 404.
     * @param int $id_carga Id Carga
     * @return Cargan el modelo cargado
     * @throws NotFoundHttpException si el modelo no se puede encontrar
     */
    protected function findModel($id_carga) {

        // Redirige a la página principal si el usuario no está autenticado
        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Cargan::findOne(['id_carga' => $id_carga])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('No existe la relación entre el cargador y el portátil');

    }

}
