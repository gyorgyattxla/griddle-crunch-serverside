<?php

use app\models\Allergen;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Tag;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var app\models\Meal $model */
/** @var yii\widgets\ActiveForm $form */

$allergens = Allergen::find()->all();
$allergenList = ArrayHelper::map($allergens, 'id', 'name');

$tags = Tag::find()->all();
$tagList = ArrayHelper::map($tags, 'id', 'name');
?>

<div class="meal-form">



    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ingredients')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'tag_ids')->widget(Select2::class, [
        'data' => $tagList,
        'options' => [
            'multiple' => true,
            'placeholder' => 'Válassz tageket...'
        ],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]) ?>

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

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
