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
use app\models\Cursan;
use app\models\Cursos;
use app\models\Portatiles;

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

    public function actionGraficos() {

        $portatiles_disponibles = Portatiles::find()->where('estado = "Disponible"')->count();
        $portatiles_no_disponibles = Portatiles::find()->where('estado = "No disponible"')->count();
        $portatiles_averiados = Portatiles::find()->where('estado = "Averiado"')->count();
        $cargadores_disponibles = Cargadores::find()->where('estado = "Disponible"')->count();
        $cargadores_no_disponibles = Cargadores::find()->where('estado = "No disponible"')->count();
        $cargadores_averiados = Cargadores::find()->where('estado = "Averiado"')->count();
        $curso_actual = Cursan::getCursoActual();
        $uso_ciclo = Alumnos::find()->select(['cursos.nombre', 'COUNT(*) AS cantidad'])->joinWith('cursan')->joinWith('cursan.curso')->where(['cursan.curso_academico' => $curso_actual])->groupBy('cursos.nombre')->asArray()->all();
        $almacenes = Almacenes::find()->select(['id_almacen', 'aula', 'capacidad'])->distinct();
    

        return $this->render('graficos', [
            'portatiles_disponibles' => $portatiles_disponibles,
            'portatiles_no_disponibles' => $portatiles_no_disponibles,
            'portatiles_averiados' => $portatiles_averiados,
            'cargadores_disponibles' => $cargadores_disponibles,
            'cargadores_no_disponibles' => $cargadores_no_disponibles,
            'cargadores_averiados' => $cargadores_averiados,
            'uso_ciclo' => $uso_ciclo,
            'almacenes' => $almacenes,
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
