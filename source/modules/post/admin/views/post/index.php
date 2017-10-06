<?php

use source\core\grid\GridView;
use source\libs\Constants;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $searchModel source\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$type = 'post';
$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;

$this->toolbars([
    Html::a('新建', ['create'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
    //Html::a('设置', ['setting/index'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'layout' => "{items}\n{pager}",
    'columns' => [
        [
            'class' => 'source\core\grid\IdColumn',
        ],
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
        ['class' => 'source\core\grid\ActionColumn'],
    ],
]);