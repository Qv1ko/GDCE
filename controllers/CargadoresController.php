<?php

namespace app\controllers;

use Yii;
use app\models\Cargadores;
use app\models\CargadoresSearch;
use app\models\Cargan;
use app\models\Portatiles;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CargadoresController implementa las acciones CRUD para el modelo Cargadores.
 */
class CargadoresController extends Controller {

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
     * Lista todos los modelos Cargadores.
     *
     * @return string Renderiza la vista 'index' con la lista de cargadores.
     */
    public function actionIndex() {

        // Sincroniza las tablas de portátiles, cargan y cargadores con la base de datos
        Portatiles::sincronizarPortatiles();
        Cargan::sincronizarCargan();
        Cargadores::sincronizarCargadores();

        $searchModel = new CargadoresSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Cargadores();

        // Maneja la validación de formularios vía AJAX
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model); // Devuelve la validación del formulario en formato JSON
        } elseif ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'El cargador se ha añadido correctamente.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Ha ocurrido un error al añadir el cargador.');
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
     * Actualiza un modelo Cargadores existente.
     * Si la actualización es exitosa, redirige a la página de índice.
     *
     * @param int $id_cargador Identificador del cargador.
     * @return string|\yii\web\Response Renderiza la vista 'update' o redirige al índice tras la actualización.
     * @throws NotFoundHttpException si el modelo no se encuentra.
     */
    public function actionUpdate($id_cargador) {

        $model = $this->findModel($id_cargador);

        // Maneja la validación de formularios vía AJAX
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            // Si el formulario se envía por POST, guarda los cambios en el modelo
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'El cargador se ha actualizado correctamente.');
                // Redirige a la vista de índice o actualiza la vista vía AJAX
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->redirect(['index']);
            } else {
                // Renderiza la vista de actualización, ya sea vía AJAX o de forma normal
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->render('update', ['model' => $model]);
            }
        }

    }

    /**
     * Elimina un modelo Cargadores existente.
     * Si la eliminación es exitosa, redirige a la página de índice.
     *
     * @param int $id_cargador Identificador del cargador.
     * @return \yii\web\Response Redirige a la vista de índice tras la eliminación.
     * @throws NotFoundHttpException si el modelo no se encuentra.
     */
    public function actionDelete($id_cargador) {

        // Elimina todas las relaciones `cargan` asociadas con el cargador antes de eliminarlo
        foreach ($this->findModel($id_cargador)->cargan as $cargan) {
            $cargan->delete();
        }

        // Elimina el cargador
        $this->findModel($id_cargador)->delete();

        Yii::$app->session->setFlash('success', 'El cargador se ha eliminado correctamente.');
        return $this->redirect(['index']); // Redirige a la vista de índice.

    }

    /**
     * Encuentra el modelo Cargadores basado en su clave primaria.
     * Si el modelo no se encuentra, lanza una excepción 404.
     *
     * @param int $id_cargador Identificador del cargador.
     * @return Cargadores El modelo cargado.
     * @throws NotFoundHttpException si el modelo no se encuentra.
     */
    protected function findModel($id_cargador) {
        if (($model = Cargadores::findOne(['id_cargador' => $id_cargador])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('El cargador no existe');
    }

}
