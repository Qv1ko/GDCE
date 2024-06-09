<?php

namespace app\controllers;

use Yii;
use app\models\Almacenes;
use app\models\AlmacenesSearch;
use app\models\Cargadores;
use app\models\Portatiles;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * AlmacenesController implementa las acciones CRUD para el modelo Almacenes.
 */
class AlmacenesController extends Controller {

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
     * Muestra todos los modelos Almacenes.
     * @return string
     */
    public function actionIndex() {

        // Redirige a la página principal si el usuario no está autenticado
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new AlmacenesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Almacenes();

        // Maneja las validaciones AJAX
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } elseif ($this->request->isPost) {
            // Maneja el envío del formulario para crear un nuevo almacén
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'El almacén se ha añadido correctamente.');
                return $this->redirect(['index']); // Redirige a index si es exitoso
            } else {
                Yii::$app->session->setFlash('error', 'Ha ocurrido un error al añadir el almacén.');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);

    }

    /**
     * Actualiza un modelo Almacenes existente.
     * Si la actualización es exitosa, redirige a la página 'index'.
     * @param int $id_almacen ID del almacén.
     * @return string|\yii\web\Response La vista 'update' o redirección.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    public function actionUpdate($id_almacen) {

        $model = $this->findModel($id_almacen);

        // Maneja las validaciones AJAX
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } else {
            // Maneja el envío del formulario para actualizar el almacén
            if ($model->load($this->request->post()) && $model->save()) {

                // Verifica si la capacidad es suficiente
                if ($model->capacidad < Almacenes::getOcupacion($model->id_almacen)) {
                    Portatiles::updateAll(['id_almacen' => null], ['id_almacen' => $id_almacen]);
                    Cargadores::updateAll(['id_almacen' => null], ['id_almacen' => $id_almacen]);
                }

                Yii::$app->session->setFlash('success', 'El almacén se ha actualizado correctamente.');
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->redirect(['index']);
            } else {
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->render('update', ['model' => $model]);
            }
        }
    }

    /**
     * Elimina un modelo Almacenes existente.
     * Si la eliminación es exitosa, redirige a la página 'index'.
     * @param int $id_almacen ID del almacén.
     * @return \yii\web\Response Redirección a 'index'.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    public function actionDelete($id_almacen) {

        // Redirige a la página principal si el usuario no está autenticado
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        // Elimina todas las relaciones con portátiles y cargadores
        Portatiles::updateAll(['id_almacen' => null], 'id_almacen = :id_almacen', [':id_almacen' => $id_almacen]);
        Cargadores::updateAll(['id_almacen' => null], 'id_almacen = :id_almacen', [':id_almacen' => $id_almacen]);

        // Elimina el almacén
        $this->findModel($id_almacen)->delete();

        Yii::$app->session->setFlash('success', 'El almacén se ha eliminado correctamente.');
        return $this->redirect(['index']);

    }

    /**
     * Encuentra el modelo Almacenes basado en su valor de clave primaria.
     * Si el modelo no se encuentra, se lanzará una excepción HTTP 404.
     * @param int $id_almacen ID del almacén.
     * @return Almacenes El modelo encontrado.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    protected function findModel($id_almacen) {
        if (($model = Almacenes::findOne(['id_almacen' => $id_almacen])) !== null) {
            return $model; // Devuelve el modelo encontrado.
        }
        // Lanza una excepción si no se encuentra el modelo
        throw new NotFoundHttpException('El almacén no existe');
    }

}
