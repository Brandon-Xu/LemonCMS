<?php

use source\core\grid\GridView;
use source\modules\fragment\models\Fragment;
use yii\helpers\Html;


/* @var $this source\core\base\BaseView */
/* @var $searchModel source\modules\fragment\models\search\Fragment2DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$fid = app()->request->get('fid');
$fragmentModel = Fragment::findOne(['id' => $fid]);

$this->title = $fragmentModel->name.'(静态碎片)';
$this->breadcrumbs = [
    $this->title,
];
$this->toolbar = [
    Html::a('返回', ['fragment/index', 'type' => 2], ['class' => 'btn btn-default']),
    Html::a('新建', ['create', 'fid' => $fid], ['class' => 'btn btn-default']),
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [

        ['class' => 'source\core\grid\IdColumn'],
        [
            'attribute' => 'title',
            'width' => 'auto',
            'value' => function ($model, $key, $index, $column) {
                return Html::a($model->title, [
                    'fragment2-data/update',
                    'id' => $model->id,
                    'type' => 2,
                    'fid' => $model->fragment_id,
                ]);
            },
        ],
        [
            'label' => '图片',
            'value' => function ($model) {
                return $model->thumb;
            },
            'format' => 'image',
        ],
        [
            'class' => 'source\core\grid\DateTimeColumn',
            'attribute' => 'created_at',
        ], // 'created_by',
        ['class' => 'source\core\grid\SortColumn'],
        ['class' => 'source\core\grid\StatusColumn'],

        ['class' => 'source\core\grid\ActionColumn'],
    ],
]);