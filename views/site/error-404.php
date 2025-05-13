<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var yii\web\HttpException $exception */

$this->registerCssFile('@web/css/error.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);

$this->title = 'Page not found';
?>

<div class="container text-center py-5">
    <div class="error_404 d-flex justify-content-center">
        <h1 class="display-1 fw-bold text-orange content">4</h1>
        <img src="/assets/error_burger.png" class="error_img">
        <h1 class="display-1 fw-bold text-orange content">4</h1>

    </div>

    <h2 class="fw-bold">Page not Found</h2>
    <p class="mb-4 text-muted">
        Oops! The page you're looking for doesn't exist. Maybe it was moved or never existed.
    </p>
    <?= Html::a('Back to home', Yii::$app->homeUrl, ['class' => 'back_button text-white px-4 ']) ?>
</div>
