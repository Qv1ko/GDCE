<?php

namespace app\controllers;

use Yii;
use app\models\Almacenes;
use app\models\Alumnos;
use app\models\Cargadores;
use app\models\Cargan;
use app\models\Cursan;
use app\models\Cursos;
use app\models\LoginForm;
use app\models\Portatiles;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Mostrar la página de inicio.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Mostrar la información de un portátil.
     *
     * @param string $codigo Código del portátil
     * @return string
     */
    public function actionPortatil($codigo) {

        $this->layout = '/main_nofooter';

        Cargan::sincronizarCargan();
        $portatil = Portatiles::find()->where(['codigo' => $codigo])->one();

        if ($portatil) {

            $portatil->sincronizarPortatil($portatil);

            $cargador = Cargadores::find()->select('cargadores.codigo')->distinct()->innerJoin(Cargan::tableName(), 'cargadores.id_cargador = cargan.id_cargador')->innerJoin(Portatiles::tableName(), 'cargan.id_portatil = portatiles.id_portatil')->where(['portatiles.codigo' => $codigo])->scalar();
            $almacen = Almacenes::find()->select('almacenes.aula')->distinct()->innerJoin(Portatiles::tableName(), 'almacenes.id_almacen = portatiles.id_almacen')->where(['portatiles.codigo' => $codigo])->scalar();
            $alumnoManana = Alumnos::find()->innerJoin(Cursan::tableName(), 'alumnos.id_alumno = cursan.id_alumno')->innerJoin(Cursos::tableName(), 'cursan.id_curso = cursos.id_curso')->innerJoin(Portatiles::tableName(), 'alumnos.id_portatil = portatiles.id_portatil')->where(['cursos.turno' => 'Mañana', 'estado_matricula' => "Matriculado", 'curso_academico' => Cursan::getCursoActual(), 'portatiles.codigo' => $codigo])->one();
            $alumnoTarde = Alumnos::find()->innerJoin(Cursan::tableName(), 'alumnos.id_alumno = cursan.id_alumno')->innerJoin(Cursos::tableName(), 'cursan.id_curso = cursos.id_curso')->innerJoin(Portatiles::tableName(), 'alumnos.id_portatil = portatiles.id_portatil')->where(['cursos.turno' => 'Tarde', 'estado_matricula' => "Matriculado", 'curso_academico' => Cursan::getCursoActual(), 'portatiles.codigo' => $codigo])->one();
            $listaAlumnosManana = Alumnos::getListaAlumnosManana();
            $listaAlumnosSoloManana = Alumnos::getListaAlumnosSoloManana();
            $listaAlumnosTarde = Alumnos::getListaAlumnosTarde();
            $listaAlumnosSoloTarde = Alumnos::getListaAlumnosSoloTarde();

            return $this->renderAjax('_portatil', [
                'portatil' => $portatil,
                'estado' => $portatil->estado,
                'cargador' => $cargador,
                'almacen' => $almacen,
                'alumnoManana' => $alumnoManana,
                'alumnoTarde' => $alumnoTarde,
                'listaAlumnosManana' => $listaAlumnosManana,
                'listaAlumnosSoloManana' => $listaAlumnosSoloManana,
                'listaAlumnosTarde' => $listaAlumnosTarde,
                'listaAlumnosSoloTarde' => $listaAlumnosSoloTarde,
            ]);

        } else {
            Yii::$app->session->setFlash('error', 'No se encontró ningún portátil con código ' . $codigo);
            return $this->redirect(['index']);
        }

    }

    /**
     * Mostrar la información de un cargador.
     *
     * @param string $codigo Código del cargador
     * @return string
     */
    public function actionCargador($codigo) {

        $this->layout = '/main_nofooter';

        Cargan::sincronizarCargan();
        Cargadores::sincronizarCargadores();

        $cargador = Cargadores::find()->where(['codigo' => $codigo])->one();

        if ($cargador) {

            $portatil = Portatiles::find()->innerJoin(Cargan::tableName(), 'portatiles.id_portatil = cargan.id_portatil')->innerJoin(Cargadores::tableName(), 'cargan.id_cargador = cargadores.id_cargador')->where(['cargadores.id_cargador' => $cargador->id_cargador])->one();
            $almacen = Almacenes::find()->select('almacenes.aula')->distinct()->innerJoin(Cargadores::tableName(), 'almacenes.id_almacen = cargadores.id_almacen')->where(['cargadores.codigo' => $codigo])->scalar();
    
            return $this->renderAjax('_cargador', [
                'cargador' => $cargador,
                'portatil' => $portatil,
                'estado' => $cargador->estado,
                'almacen' => $almacen,
            ]);

        } else {
            Yii::$app->session->setFlash('error', 'No se encontró ningún cargador con código ' . $codigo);
            return $this->redirect(['index']);
        }

    }

    /**
     * Acción para mostrar el panel principal con datos estadísticos.
     *
     * @return string
     */
    public function actionPanel() {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        Portatiles::sincronizarPortatiles();
        Cargan::sincronizarCargan();
        Cargadores::sincronizarCargadores();

        $portatilesDisponibles = Portatiles::find()->where('estado = "Disponible"')->count();
        $portatilesNoDisponibles = Portatiles::find()->where('estado = "No disponible"')->count();
        $portatilesAveriados = Portatiles::find()->where('estado = "Averiado"')->count();

        $porcentajePortatilesDisponibles = ($portatilesDisponibles == 0) ? 0 : number_format((float)(($portatilesDisponibles * 100) / ($portatilesDisponibles + $portatilesNoDisponibles + $portatilesAveriados)), 2, '.', '');

        $listadoPortatilesDisponibles = new ActiveDataProvider([
            'query' => Portatiles::find()->where(['estado' => 'Disponible'])->with('almacen'),
            'pagination' => [
                'pageSize' => false,
            ],
        ]);

        $listadoPortatilesAveriados = new ActiveDataProvider([
            'query' => Portatiles::find()->distinct()->where(['estado' => 'Averiado']),
            'pagination' => false,
        ]);

        $cargadoresDisponibles = Cargadores::find()->where('estado = "Disponible"')->count();
        $cargadoresNoDisponibles = Cargadores::find()->where('estado = "No disponible"')->count();
        $cargadoresAveriados = Cargadores::find()->where('estado = "Averiado"')->count();

        $porcentajeCargadoresDisponibles = ($cargadoresDisponibles == 0) ? 0 : number_format((float)(($cargadoresDisponibles * 100) / ($cargadoresDisponibles + $cargadoresNoDisponibles + $cargadoresAveriados)), 2, '.', '');

        $listadoCargadoresDisponibles = new ActiveDataProvider([
            'query' => Cargadores::find()->where(['estado' => 'Disponible'])->with('almacen'),
            'pagination' => [
                'pageSize' => false,
            ],
        ]);

        $listadoCargadoresAveriados = new ActiveDataProvider([
            'query' => Cargadores::find()->distinct()->where(['estado' => 'Averiado']),
            'pagination' => false,
        ]);

        $almacenes = Almacenes::find()->select(['CONCAT("Almacén ", almacenes.aula) AS almacen', 'almacenes.capacidad', 'COALESCE(portatiles.count, 0) + COALESCE(cargadores.count, 0) AS dispositivos'])->leftJoin(['portatiles' => (new \yii\db\Query())->select(['id_almacen', 'COUNT(*) AS count'])->from('Portatiles')->groupBy('id_almacen')], 'almacenes.id_almacen = portatiles.id_almacen')->leftJoin(['cargadores' => (new \yii\db\Query())->select(['id_almacen', 'COUNT(*) AS count'])->from('Cargadores')->groupBy('id_almacen')], 'almacenes.id_almacen = cargadores.id_almacen')->asArray()->all();
        
        $usoCiclo = Alumnos::find()->select(['cursos.sigla', 'COUNT(*) AS cantidad'])->joinWith('cursan')->joinWith('cursan.curso')->where(['cursan.curso_academico' => Cursan::getCursoActual()])->groupBy('cursos.nombre')->asArray()->all();

        return $this->render('panel', [
            'portatilesDisponibles' => $portatilesDisponibles,
            'portatilesNoDisponibles' => $portatilesNoDisponibles,
            'portatilesAveriados' => $portatilesAveriados,
            'porcentajePortatilesDisponibles' => $porcentajePortatilesDisponibles,
            'listadoPortatilesDisponibles' => $listadoPortatilesDisponibles,
            'listadoPortatilesAveriados' => $listadoPortatilesAveriados,
            'cargadoresDisponibles' => $cargadoresDisponibles,
            'cargadoresNoDisponibles' => $cargadoresNoDisponibles,
            'cargadoresAveriados' => $cargadoresAveriados,
            'porcentajeCargadoresDisponibles' => $porcentajeCargadoresDisponibles,
            'listadoCargadoresDisponibles' => $listadoCargadoresDisponibles,
            'listadoCargadoresAveriados' => $listadoCargadoresAveriados,
            'almacenes' => $almacenes,
            'usoCiclo' => $usoCiclo,
        ]);

    }

    /**
     * Acción de login.
     *
     * @return Response|string
     */
    public function actionLogin() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);

    }

    /**
     * Acción de logout.
     *
     * @return Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
