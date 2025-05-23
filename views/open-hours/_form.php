<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OpenHours $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="open-hours-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'day_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'open_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'close_time')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
