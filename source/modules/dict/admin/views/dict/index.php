<?php

use source\core\grid\GridView;
use source\modules\dict\models\DictCategory;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $searchModel source\modules\dict\models\search\DictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$category = app()->request->get('category');
$categoryModel = DictCategory::findOne(['id' => $category]);

$this->title = $this->t('Dictionary: {name}', NULL, ['name'=> $categoryModel->name]);

$this->breadcrumbs = [
    [$this->t('Dictionary Manage'), ['dict-category/index']],
    $categoryModel->name
];

$this->toolbar = [
    Html::a(Yii::t('app', 'Back'), ['/dict/dict-category'], ['class' => 'btn btn-warning']),
    Html::a(Yii::t('app', 'Create'), ['create', 'category' => $category], ['class' => 'btn btn-primary']),
];

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [ 'class' => 'source\core\grid\IdColumn' ],
        [
            'attribute' => 'name',
            'width' => '250px',
        ],
        [
            'attribute' => 'value',
            'format' => 'ntext',
            'width' => 'auto',
        ],

        // 'description',
        // 'thumb',
        [ 'class' => 'source\core\grid\SortColumn' ],
        [ 'class' => 'source\core\grid\StatusColumn' ],
        [
            'class' => 'source\core\grid\ActionColumn',
            'queryParams' => ['view' => ['category' => $category]],
        ],
    ],
]);