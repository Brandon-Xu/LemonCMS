<?php

use source\core\grid\GridView;
use source\libs\Constants;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $searchModel source\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$type = 'post';
$this->title = $this->t('Post Manage');
$this->breadcrumbs = [
    $this->title
];

$this->toolbar = [
    Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary']),
];
echo GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'summary' => $this->title,
    'columns' => [
        ['class' => 'source\core\grid\IdColumn'],
        [
            'attribute' => 'title',
            'headerOptions' => ['width' => 'auto'],
        ],
        [
            'class' => 'source\core\grid\DateTimeColumn',
            'attribute' => 'updated_at',
        ],
        [
            'label' => '点击快速添至导航',
            'format' => 'raw',
            'value' => function ($item) {
                return Html::a("/article/{$item->id}", [
                    '/admin/menu/menu/create',
                    'category' => 'main',
                    'url' => "/article/{$item->id}",
                    'name' => $item->title,
                ]);
            },
            'width' => '150px',
        ],
        'userText:raw',
        'comment_count',
        'view_count',
        [
            'attribute' => 'status',
            'content' => function ($model, $key, $index, $gridView) {
                return Constants::getStatusItemsForContent($model->status);
            },
        ],
        ['class' => 'source\core\grid\ActionColumn'],
    ],
]);