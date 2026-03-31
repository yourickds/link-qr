<?php

use app\models\ShortLink;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\ShortLink $model */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Short Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="short-link-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'code',
                'value' => function (ShortLink $model) {
                    return Html::a($model->code, ['redirect/index', 'code' => $model->code], ['target' => '_blank']);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'url',
                'value' => function (ShortLink $model) {
                    return Html::a($model->url, $model->url, ['target' => '_blank']);
                },
                'format' => 'raw',
            ],
            'visits',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => \yii\bootstrap5\LinkPager::class,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ip',
            'user_agent',
            'created_at:datetime',
        ],
    ]); ?>

</div>
