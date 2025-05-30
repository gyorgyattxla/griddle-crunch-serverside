<?php

use app\models\OpenHours;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OpenHoursSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Open Hours';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="open-hours-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Open Hours', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'day_name',
            'open_time',
            'close_time',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, OpenHours $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
