<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Allergen $model */

$this->title = 'Create Allergen';
$this->params['breadcrumbs'][] = ['label' => 'Allergens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="allergen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
