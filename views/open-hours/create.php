<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OpenHours $model */

$this->title = 'Create Open Hours';
$this->params['breadcrumbs'][] = ['label' => 'Open Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="open-hours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
