<?php

use source\core\grid\GridView;
use source\libs\Constants;
use source\modules\taxonomy\models\TaxonomyCategory;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $searchModel source\modules\taxonomy\models\search\TaxonomySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$category = app()->request->get('category');
$categoryModel = TaxonomyCategory::findOne(['id' => $category]);

$this->title = $categoryModel['name'];
$this->breadcrumbs = [
    ['分类管理', ['taxonomy']],
    $categoryModel['name'],
];

$this->toolbar = [
    Html::a('返回', ['taxonomy-category/index'], ['class' => 'btn btn-warning']),
    Html::a('新建', ['create', 'category' => $category], ['class' => 'btn btn-primary']),
];


echo GridView::widget([
    'dataProvider' => $dataProvider, //'filterModel' => $searchModel,
    'columns' => [
        [ 'class' => 'source\core\grid\IdColumn' ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'width' => 'auto',
            'value' => function ($model, $key, $index, $column) use ($category) {
                return str_repeat(Constants::TabSize, $model->level).Html::a($model->name, [
                        "/admin/{$category}/{$category}",
                        'taxonomy_id' => $model->id,
                    ]);
            },
        ],
        // 'description',
        // 'contents',
        [
            'label' => '点击快速添至导航',
            'format' => 'raw',
            'value' => function ($item) {
                return Html::a("/taxonomy/{$item->id}", [
                    '/admin/menu/menu/create',
                    'category' => 'main',
                    'url' => "/taxonomy/{$item->id}",
                    'name' => $item->name,
                ]);
            },
            'width' => '120px',
        ],
        [ 'class' => 'source\core\grid\SortColumn' ],
        [
            'class' => 'source\core\grid\ActionColumn',
            'queryParams' => ['view' => ['category' => $category]],
        ],
    ],
]); ?>

