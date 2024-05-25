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

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Almacenes::sincronizarAlmacenes();

        $searchModel = new AlmacenesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Almacenes();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
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
     * Si la actualización es exitosa, el navegador será redirigido a la página 'index'.
     * @param int $id_almacen ID del almacén
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException si el modelo no puede ser encontrado
     */
    public function actionUpdate($id_almacen) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = $this->findModel($id_almacen);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);

    }

    /**
     * Elimina un modelo Almacenes existente.
     * Si la eliminación es exitosa, el navegador será redirigido a la página 'index'.
     * @param int $id_almacen ID del Almacén
     * @return \yii\web\Response
     * @throws NotFoundHttpException si el modelo no puede ser encontrado
     */
    public function actionDelete($id_almacen) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Portatiles::updateAll(['id_almacen' => null], 'id_almacen = :id_almacen', [':id_almacen' => $id_almacen]);
        Cargadores::updateAll(['id_almacen' => null], 'id_almacen = :id_almacen', [':id_almacen' => $id_almacen]);

        // Elimina el almacén
        $this->findModel($id_almacen)->delete();

        return $this->redirect(['index']);

    }

    /**
     * Encuentra el modelo Almacenes basado en su valor de clave primaria.
     * Si el modelo no se encuentra, se lanzará una excepción HTTP 404.
     * @param int $id_almacen ID del Almacén
     * @return Almacenes el modelo cargado
     * @throws NotFoundHttpException si el modelo no puede ser encontrado
     */
    protected function findModel($id_almacen) {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (($model = Almacenes::findOne(['id_almacen' => $id_almacen])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('❌ El almacén no existe.');

    }

}
