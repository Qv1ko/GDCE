<?php

    /** @var yii\web\View $this */
    /** @var string $content */

    use app\assets\AppAsset;
    use app\widgets\Alert;
    use yii\bootstrap4\Breadcrumbs;
    use yii\bootstrap4\Html;
    use yii\bootstrap4\Nav;
    use yii\bootstrap4\NavBar;

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
        NavBar::begin([
            'brandLabel' => Html::img("@web/images/logo_sm.png"),
            'brandUrl' => ['/site/index'],
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark fixed-top',
            ],
            'innerContainerOptions' => [
                // Separar los elementos del header
                'class' => 'container-fluid',
            ],
        ]);
        $menuItems = [
            ['label' => 'INICIO', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'INICIAR SESIÓN', 'url' => ['/site/login']];
        } else {
            $menuItems[] = ['label' => 'PANEL', 'url' => ['/site/panel']];
            $menuItems[] = ['label' => 'PORTÁTILES', 'url' => ['/portatiles/index']];
            $menuItems[] = ['label' => 'APLICACIONES', 'url' => ['/aplicaciones/index']];
            $menuItems[] = ['label' => 'CARGADORES', 'url' => ['/cargadores/index']];
            $menuItems[] = ['label' => 'ALMACENES', 'url' => ['/almacenes/index']];
            $menuItems[] = ['label' => 'ALUMNOS', 'url' => ['/alumnos/index']];
            $menuItems[] = ['label' => 'CURSOS', 'url' => ['/cursos/index']];
            $menuItems[] = ['label' => 'CERRAR SESIÓN (' . strtoupper(Yii::$app->user->identity->username) . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <!-- <div class="container"> -->
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        <!-- </div> -->
    </main>

    <?php $this->endBody() ?>
    </body>

</html>

<?php $this->endPage() ?>
