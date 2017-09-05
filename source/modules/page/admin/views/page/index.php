<?php

use source\core\grid\GridView;
use source\libs\Constants;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $searchModel source\models\search\ContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$type = 'post';
$this->title = '单面管理';
$this->params['breadcrumbs'][] = $this->title;


?>
<?php $this->toolbars([
    Html::a('新建', ['create'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
    Html::a('设置', ['setting/index'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, //'filterModel' => $searchModel,
    'layout' => "{items}\n{pager}", 'columns' => [

        [
            'class' => 'source\core\grid\IdColumn',
        ],

        [
            'attribute' => 'title', 'headerOptions' => ['width' => 'auto'],
        ], [
            'class' => 'source\core\grid\DateTimeColumn', 'attribute' => 'updated_at',
        ],

        //'allow_comment',
        //'comments',

        'userText:html',
        'comment_count',
        'view_count',
        [
            'attribute' => 'status', 'width' => '25px', 'content' => function ($model, $key, $index, $gridView) {
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
]); ?>

