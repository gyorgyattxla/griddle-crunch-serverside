<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OpenHours $model */

$this->title = 'Update Open Hours: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Open Hours', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="open-hours-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
