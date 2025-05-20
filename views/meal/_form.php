<?php

use app\assets\MealAsset;
use app\models\Allergen;
use app\models\Category;
use app\models\Tag;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */
/** @var app\models\Tag $tagModel */
/** @var yii\widgets\ActiveForm $form */

$allergens = Allergen::find()->orderBy('name')->all();
$allergenList = ArrayHelper::map($allergens, 'id', 'name');

$tags = Tag::find()->orderBy('name')->all();
$tagList = ArrayHelper::map($tags, 'id', 'name');

$categories = ArrayHelper::map(Category::find()->orderBy('name')->all(), 'id', 'name');
MealAsset::register($this);
?>

<div class="meal-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingredients')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Válassz kategóriát...']) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tag_ids')->widget(Select2::class, [
                'data' => $tagList,
                'options' => [
                    'multiple' => true,
                    'placeholder' => 'Válassz címkéket...'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]) ?>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <?= Html::button('Új címke', ['class' => 'btn btn-primary mt-4', 'id' => 'btn-new-tag']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'allergens')->widget(Select2::class, [
                'data' => $allergenList,
                'options' => [
                    'multiple' => true,
                    'placeholder' => 'Válassz allergéneket...'
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ]
            ]) ?>
        </div>
        <div class="col-md-1 d-flex align-items-center">
            <?= Html::button('Új allergén', ['class' => 'btn btn-primary mt-4', 'id' => 'btn-new-allergen']) ?>
        </div>
    </div>

    <?= $form->field($model, 'price')->textInput(['type' => 'number', 'min' => 0]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Mentés', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <!-- Új címke létrehozás modal -->
    <?php
    Modal::begin([
        'title' => '<h5>Új címke létrehozása</h5>',
        'id' => 'modal-tag',
        'size' => Modal::SIZE_DEFAULT,
    ]);
    echo "<div id='modal-tag-content'></div>";  // AJAX tartalom ide töltődik
    Modal::end();
    ?>

    <!-- Új allergén létrehozás modal -->
    <?php
    Modal::begin([
        'title' => '<h5>Új allergén létrehozása</h5>',
        'id' => 'modal-allergen',
        'size' => Modal::SIZE_DEFAULT,
    ]);
    echo "<div id='modal-allergen-content'></div>";  // AJAX tartalom ide töltődik
    Modal::end();
    ?>

</div>
