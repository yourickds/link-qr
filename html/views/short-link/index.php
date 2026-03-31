<?php

use app\models\ShortLink;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Short Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="short-link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
                'class' => \yii\bootstrap5\LinkPager::class,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, ShortLink $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
