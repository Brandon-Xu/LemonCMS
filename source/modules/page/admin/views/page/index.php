<?php

use source\core\grid\GridView;
use source\libs\Constants;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $searchModel source\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = $this->t('Page Manage');
$this->breadcrumbs = [
    $this->title
];

$this->toolbar = [
    Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary']),
    //Html::a('设置', ['setting/index'], ['class' => 'btn btn-default']),
];
echo GridView::widget([
    'dataProvider' => $dataProvider, //'filterModel' => $searchModel,
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
            'width' => '120px',
        ],
        'userText:raw',
        'comment_count',
        'view_count',
        [
            'attribute' => 'status',
            'width' => '25px',
            'content' => function ($model, $key, $index, $gridView) {
                return Constants::getStatusItemsForContent($model->status);
            },
        ],
        // 'diggs',
        // 'burys',
        // 'sticky',
        // 'password',
        // 'visibility',
        //'status',
        // 'thumb',
        //
        // 'alias',
        // 'excerpt',
        // 'content:ntext',
        // 'content_type',
        // 'template',

        ['class' => 'source\core\grid\ActionColumn'],
    ],
]);