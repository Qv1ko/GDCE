<?php

    /** @var yii\web\View $this */
    /** @var string $content */

    use app\assets\AppAsset;
    use app\widgets\Alert;
    use yii\bootstrap4\Breadcrumbs;
    use yii\bootstrap4\Html;
    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;

    // Se registra el conjunto de recursos de la aplicación (CSS, JavaScript, etc.).
    AppAsset::register($this);

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <?php $this->registerCsrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
            <!-- Favicon -->
            <link rel="shortcut icon" href=<?= Yii::$app->request->baseUrl . "/favicon.ico"; ?> />
            <link rel="icon" type="image/x-icon" href=<?= Yii::$app->request->baseUrl . "/favicon.ico"; ?> />
            <!-- Tipografía -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        </head>
        <body class="d-flex flex-column h-100">
            <?php $this->beginBody() ?>
                <header>
                    <?php

                        // Barra de navegación
                        NavBar::begin([
                            'brandLabel' => Html::img("@web/images/logo_sm.png"), // Logo
                            'brandUrl' => ['/site/index'],
                            'options' => [
                                'class' => 'navbar navbar-expand-md navbar-dark fixed-top', // CSS para encabezado
                            ],
                            'innerContainerOptions' => [
                                'class' => 'container-fluid', // CSS para el contenedor interno del encabezado
                            ],
                        ]);

                            // Elementos del menú
                            $menuItems = [
                                ['label' => 'INICIO', 'url' => ['/site/index']], // Página de inicio
                                ['label' => 'PANEL', 'url' => ['/site/panel']], // Página de panel
                            ];

                            // Si el usuario no está autenticado, se muestra la opción de iniciar sesión
                            if (Yii::$app->user->isGuest) {
                                $menuItems[] = ['label' => 'INICIAR SESIÓN', 'url' => ['/site/login']];
                            } else {
                                // Si el usuario está autenticado, se muestran opciones adicionales
                                $menuItems[] = ['label' => 'PORTÁTILES', 'url' => ['/portatiles/index']];
                                $menuItems[] = ['label' => 'APLICACIONES', 'url' => ['/aplicaciones/index']];
                                $menuItems[] = ['label' => 'CARGADORES', 'url' => ['/cargadores/index']];
                                $menuItems[] = ['label' => 'ALMACENES', 'url' => ['/almacenes/index']];
                                $menuItems[] = ['label' => 'ALUMNOS', 'url' => ['/alumnos/index']];
                                $menuItems[] = ['label' => 'CURSOS', 'url' => ['/cursos/index']];
                                // Opción de cerrar sesión, con confirmación mediante POST
                                $menuItems[] = [
                                    'label' => 'CERRAR SESIÓN (' . strtoupper(Yii::$app->user->identity->username) . ')', 
                                    'url' => ['/site/logout'], 
                                    'linkOptions' => ['data-method' => 'post']
                                ];
                            }

                            // Se renderiza el menú de navegación
                            echo Nav::widget([
                                'options' => ['class' => 'navbar-nav ml-auto'],  // Clases CSS para el menú
                                'items' => $menuItems,  // Ítems del menú
                            ]);

                        NavBar::end();

                    ?>
                </header>
                <!-- Contenido de la página -->
                <main role="main" class="flex-shrink-0">
                    <div class="container">
                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                        <?= Alert::widget() ?>
                        <!-- Contenido de la página -->
                        <?= $content ?>
                    </div>
                </main>
            <?php $this->endBody() ?>
        </body>
    </html>
<?php $this->endPage() ?>
