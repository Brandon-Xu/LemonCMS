<?php

use source\core\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this source\core\base\BaseView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->breadcrumbs = [
    $this->title,
];

$this->toolbar = [
    Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary']),
];

echo GridView::widget([
    'dataProvider' => $dataProvider, //'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'source\core\grid\TextIdColumn',
        ], [
            'attribute' => 'name', 'format' => 'raw', 'width' => '250px',
            'value' => function ($model, $key, $index, $column) {

                return Html::a($model->name, ['taxonomy/index', 'category' => $model->id]);
            },
        ], [
            'attribute' => 'description', 'width' => 'auto',
        ], [
            'class' => 'source\core\grid\ActionColumn',
            'template' => '{update}',
            'buttons' => [
                'view' => function ($url, $model, $key, $index, $column) {

                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to([
                        'taxonomy/index', 'category' => $key,
                    ]), [
                        'title' => Yii::t('yii', 'View'), 'data-pjax' => '0',
                    ]);
                },
            ],
        ],
    ],
]);