<?php

namespace app\controllers;

use Yii;
use app\models\Aplicaciones;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
     * Lista todos los modelos `Aplicaciones`.
     *
     * @return string Renderiza la vista 'index' con la lista de aplicaciones.
     */
    public function actionIndex() {

        if (Yii::$app->user->isGuest) {
            return $this->goHome(); // Redirige a la página de inicio si el usuario no está autenticado
        }

        Aplicaciones::sincronizarAplicaciones(); // Método que probablemente sincroniza las aplicaciones en la base de datos

        $model = new Aplicaciones();

        // Verifica si la solicitud es AJAX y si el modelo se carga con datos POST
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model); // Devuelve la validación del formulario en formato JSON
        } elseif ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'La aplicación se ha añadido correctamente.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Ha ocurrido un error al añadir la aplicación.');
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
     * Actualiza un modelo `Aplicaciones` existente.
     * Si la actualización es exitosa, redirige a la página de índice.
     *
     * @param int $id_aplicacion Identificador de la aplicación.
     * @return string|\yii\web\Response Renderiza la vista 'update' o redirige al índice tras la actualización.
     * @throws NotFoundHttpException si el modelo no se encuentra.
     */
    public function actionUpdate($id_aplicacion) {

        $model = $this->findModel($id_aplicacion);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model); // Devuelve la validación del formulario en formato JSON
        } else {
        
            $nombre = $model->aplicacion; // Guarda el nombre de la aplicación

            if ($model->load($this->request->post())) {

                // Busca todas las aplicaciones que coinciden con el nombre y tienen un id_portatil no nulo
                $aplicaciones = Aplicaciones::find()->where(['aplicacion' => $nombre])->andWhere(['not', ['id_portatil' => null]])->all();

                foreach ($aplicaciones as $aplicacion) {
                    $aplicacion->aplicacion = $model->aplicacion; // Actualiza el nombre de la aplicación
                    $aplicacion->save(); // Guarda los cambios
                }

                $model->save(); // Guarda los cambios del modelo principal

                Yii::$app->session->setFlash('success', 'La aplicación se ha actualizado correctamente.');
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->redirect(['index']);

            } else {
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->render('update', ['model' => $model]);
            }

        }

    }

    /**
     * Elimina un modelo `Aplicaciones` existente.
     * Si la eliminación es exitosa, redirige a la página de índice.
     *
     * @param int $id_aplicacion Identificador de la aplicación.
     * @return \yii\web\Response Redirige a la vista 'index' tras la eliminación.
     * @throws NotFoundHttpException si el modelo no se encuentra.
     */
    public function actionDelete($id_aplicacion) {

        // Encuentra y elimina todas las aplicaciones que coinciden con el nombre de la aplicación
        $aplicaciones = Aplicaciones::find()->where(['aplicacion' => $this->findModel($id_aplicacion)->aplicacion])->all();

        foreach ($aplicaciones as $aplicacion) {
            $aplicacion->delete(); // Elimina cada aplicación
        }

        Yii::$app->session->setFlash('success', 'La aplicación se ha eliminado correctamente.');
        return $this->redirect(['index']);

    }

    /**
     * Encuentra el modelo `Aplicaciones` basado en su clave primaria.
     * Si el modelo no se encuentra, lanza una excepción 404.
     *
     * @param int $id_aplicacion Identificador de la aplicación.
     * @return Aplicaciones El modelo cargado.
     * @throws NotFoundHttpException si el modelo no se encuentra.
     */
    protected function findModel($id_aplicacion) {
        if (($model = Aplicaciones::findOne(['id_aplicacion' => $id_aplicacion])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('La aplicación no existe');
    }

}
