<?php

namespace app\controllers;

use Yii;
use app\models\Cursan;
use app\models\Cursos;
use app\models\CursosSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
     * Muestra todos los modelos de `Cursos`.
     * Maneja la búsqueda y filtrado de cursos y la creación de nuevos cursos.
     * @return string Renderiza la vista 'index' con la lista de cursos.
     */
    public function actionIndex() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $searchModel = new CursosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Cursos();

        // Validación y creación del curso en caso de solicitud AJAX o POST
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model); // Devuelve la validación en formato JSON
        } elseif ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Cursos::setSigla($model); // Asigna la sigla del curso
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
     * Actualiza un modelo `Cursos` existente.
     * Redirige a la vista 'index' después de una actualización exitosa.
     * @param int $id_curso Id del curso a actualizar.
     * @return string|\yii\web\Response Renderiza la vista 'update' o redirige a 'index'.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    public function actionUpdate($id_curso) {

        $model = $this->findModel($id_curso);

        // Validación y actualización del curso en caso de solicitud AJAX o POST
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model); // Devuelve la validación en formato JSON
        } else {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Cursos::setSigla($model); // Asigna la sigla del curso
                Yii::$app->session->setFlash('success', 'El curso se ha actualizado correctamente.');
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->redirect(['index']);
            } else {
                return (Yii::$app->request->isAjax) ? $this->renderAjax('update', ['model' => $model]) : $this->render('update', ['model' => $model]);
            }
        }

    }

    /**
     * Elimina un modelo `Cursos` existente.
     * Redirige a la vista 'index' después de una eliminación exitosa.
     * @param int $id_curso Id del curso a eliminar.
     * @return \yii\web\Response Redirige a la vista 'index'.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    public function actionDelete($id_curso) {

        Cursan::deleteAll(['id_curso' => $id_curso]); // Elimina todas las relaciones del curso con alumnos

        $this->findModel($id_curso)->delete(); // Elimina el curso

        Yii::$app->session->setFlash('success', 'El curso se ha eliminado correctamente.');
        return $this->redirect(['index']);

    }

    /**
     * Encuentra el modelo `Cursos` basado en su clave primaria.
     * Lanza una excepción 404 si el modelo no se encuentra.
     * @param int $id_curso Id del curso.
     * @return Cursos El modelo cargado.
     * @throws NotFoundHttpException si el modelo no se puede encontrar.
     */
    protected function findModel($id_curso) {
        if (($model = Cursos::findOne(['id_curso' => $id_curso])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('El curso no existe');
    }

}
