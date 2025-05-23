<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Allergen $model */

$this->title = 'Update Allergen: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Allergens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="allergen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
