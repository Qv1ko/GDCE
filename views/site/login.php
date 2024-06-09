<?php

    /** @var yii\web\View $this */
    /** @var yii\bootstrap4\ActiveForm $form */
    /** @var app\models\LoginForm $model */

    use yii\bootstrap4\ActiveForm;
    use yii\bootstrap4\Html;

    // Título de la página
    $this->title = 'Iniciar sesión';

?>

<style>
    .site-login {
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
    .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .btn {
        font-size: 16px;
        width: 100%;
        padding: 14px 20px;
    }
</style>

<div class="site-login">
    <div class="container">

        <!-- Título de la página -->
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'labelOptions' => ['class' => 'col-form-label mr-lg-7'],
                'inputOptions' => ['class' => 'form-control'],
                'errorOptions' => ['class' => 'invalid-feedback'],
            ],
        ]); ?>

            <!-- Campo para el nombre de usuario -->
            <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'placeholder' => 'Escribe el nombre del usuario',
                    'class' => 'form-control',
                ],
            ])->label($model->getAttributeLabel('username'))->textInput(['autofocus' => true]) ?>

            <!-- Campo para la contraseña -->
            <?= $form->field($model, 'password', [
                'inputOptions' => [
                    'placeholder' => 'Escribe la contraseña del usuario',
                    'class' => 'form-control',
                ],
            ])->label($model->getAttributeLabel('password'))->passwordInput() ?>

            <!-- Campo para "Recordarme" -->
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

            <!-- Botón de enviar -->
            <div class="form-group">
                <?= Html::submitButton('INICIAR SESIÓN', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
