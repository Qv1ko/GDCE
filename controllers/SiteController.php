<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Almacenes;
use app\models\Alumnos;
use app\models\Cargadores;
use app\models\Cargan;
use app\models\Cursan;
use app\models\Cursos;
use app\models\Portatiles;
use Zxing\QrReader;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
    public function actions()
    {
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionPortatil($portatil) {

        $estado = Portatiles::find()->select('estado')->distinct()->where(['codigo' => $portatil])->scalar();
        $cargador = Cargadores::find()->select('cargadores.codigo')->distinct()->innerJoin(Cargan::tableName(), 'cargadores.id_cargador = cargan.id_cargador')->innerJoin(Portatiles::tableName(), 'cargan.id_portatil = portatiles.id_portatil')->where(['portatiles.codigo' => $portatil])->scalar();
        $almacen = Almacenes::find()->select('almacenes.aula')->distinct()->innerJoin(Portatiles::tableName(), 'almacenes.id_almacen = portatiles.id_almacen')->where(['portatiles.codigo' => $portatil])->scalar();
        $alumnoTurnoManana = Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", apellidos)'])->distinct()->innerJoin(Cursan::tableName(), 'alumnos.id_alumno = cursan.id_alumno')->innerJoin(Cursos::tableName(), 'cursan.id_curso = cursos.id_curso')->innerJoin(Portatiles::tableName(), 'alumnos.id_portatil = portatiles.id_portatil')->where(['cursos.turno' => 'Mañana', 'portatiles.codigo' => $portatil])->scalar();
        $alumnoTurnoTarde = Alumnos::find()->select(['CONCAT(alumnos.nombre, " ", apellidos)'])->distinct()->innerJoin(Cursan::tableName(), 'alumnos.id_alumno = cursan.id_alumno')->innerJoin(Cursos::tableName(), 'cursan.id_curso = cursos.id_curso')->innerJoin(Portatiles::tableName(), 'alumnos.id_portatil = portatiles.id_portatil')->where(['cursos.turno' => 'Tarde', 'portatiles.codigo' => $portatil])->scalar();

        return $this->render('portatil', [
            'codigo' => $portatil,
            'estado' => $estado,
            'cargador' => $cargador,
            'almacen' => $almacen,
            'alumnoManana' => $alumnoTurnoManana,
            'alumnoTarde' => $alumnoTurnoTarde,
        ]);

    }

    public function actionGraficos() {

        if(Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $portatilesDisponibles = Portatiles::find()->where('estado = "Disponible"')->count();
        $portatilesNoDisponibles = Portatiles::find()->where('estado = "No disponible"')->count();
        $portatilesAveriados = Portatiles::find()->where('estado = "Averiado"')->count();
        $cargadoresDisponibles = Cargadores::find()->where('estado = "Disponible"')->count();
        $cargadoresNoDisponibles = Cargadores::find()->where('estado = "No disponible"')->count();
        $cargadoresAveriados = Cargadores::find()->where('estado = "Averiado"')->count();
        $cursoActual = Cursan::getCursoActual();
        $almacenes = Almacenes::find()->select(['CONCAT("Almacén ", almacenes.aula) AS almacen', 'almacenes.capacidad', 'COALESCE(portatiles.count, 0) + COALESCE(cargadores.count, 0) AS dispositivos'])->leftJoin(['portatiles' => (new \yii\db\Query())->select(['id_almacen', 'COUNT(*) AS count'])->from('Portatiles')->groupBy('id_almacen')], 'almacenes.id_almacen = portatiles.id_almacen')->leftJoin(['cargadores' => (new \yii\db\Query())->select(['id_almacen', 'COUNT(*) AS count'])->from('Cargadores')->groupBy('id_almacen')], 'almacenes.id_almacen = cargadores.id_almacen')->asArray()->all();
        $usoCiclo = Alumnos::find()->select(['cursos.nombre', 'COUNT(*) AS cantidad'])->joinWith('cursan')->joinWith('cursan.curso')->where(['cursan.curso_academico' => $cursoActual])->groupBy('cursos.nombre')->asArray()->all();

        return $this->render('graficos', [
            'portatilesDisponibles' => $portatilesDisponibles,
            'portatilesNoDisponibles' => $portatilesNoDisponibles,
            'portatilesAveriados' => $portatilesAveriados,
            'cargadoresDisponibles' => $cargadoresDisponibles,
            'cargadoresNoDisponibles' => $cargadoresNoDisponibles,
            'cargadoresAveriados' => $cargadoresAveriados,
            'almacenes' => $almacenes,
            'usoCiclo' => $usoCiclo,
        ]);

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
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
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
