<?php

use app\models\Meal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Meal $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="meal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'ingredients',
            'category_id',
            'price',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->image) {
                        return Html::img(Yii::getAlias('@web/uploads/') . $model->image, [
                            'alt' => $model->name,
                            'style' => 'max-width: 200px; max-height: 200px;',
                        ]);
                    } else {
                        return '(nincs kép)';
                    }
                },
            ],
            [
                'attribute' => 'allergens',
                'value' => function (Meal $model) {
                    return json_encode($model->getAllergenNumber());
                }
            ],
        ],
    ]) ?>

</div>
