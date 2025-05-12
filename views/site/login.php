<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('@web/css/login.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
?>

<div class="login-page">
    <div class="login-container">

        <!-- Bal oldali kép -->
        <div class="image-side"></div>

        <!-- Jobb oldali űrlap -->
        <div class="form-side">
            <div class="login-card">
                <div class="logo-img">
                    <img alt="logo" src="/assets/logo.png" />
                </div>

                <div class="header">
                    <h2>Login to your Account</h2>
                    <p>See what is going on with your business.</p>
                </div>

                <button class="btn btn-outline-secondary w-75 mb-3 google-btn">
                    <img
                            src="https://img.icons8.com/color/16/000000/google-logo.png"
                            alt="Google"
                    />
                    &nbsp; Continue with Google
                </button>

                <div class="divider-text">or sign in with email</div>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'form-label'],
                        'inputOptions' => ['class' => 'form-control'],
                        'errorOptions' => ['class' => 'invalid-feedback'],
                    ],
                ]); ?>

                <div class="mb-3">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </div>

                <div class="mb-3">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>

                <div class="mb-3 form-check">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"form-check\">{input} {label}</div>\n{error}",
                        'labelOptions' => ['class' => 'form-check-label'],
                        'inputOptions' => ['class' => 'form-check-input'],
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100 login-btn', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="login-footer">
                    <div class="text-center mt-3">
                        <a href="#">Forgot Password?</a>
                    </div>

                    <div class="text-center mt-3">
                        Not registered yet? <a href="#">Create an account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
