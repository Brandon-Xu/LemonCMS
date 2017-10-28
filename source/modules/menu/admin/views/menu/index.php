<?php

use source\core\grid\GridView;
use source\libs\Constants;
use source\modules\menu\models\MenuCategory;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $dataProvider yii\data\ActiveDataProvider */

$category = app()->request->get('category');
$categoryModel = MenuCategory::findOne(['id' => $category]);

$this->title = $categoryModel['name'];
$this->breadcrumbs = [
    [ $this->t('Menu Categories'), ['category/index'] ],
    $this->title,
];

$this->toolbar =[
    Html::a(Yii::t('app', 'Back'), ['category/index'], ['class' => 'btn btn-warning']),
    Html::a(Yii::t('app', 'Create'), ['create', 'category' => $category], ['class' => 'btn btn-success']),
];

\yii\widgets\Pjax::begin();
echo GridView::widget([
    //'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => [
        [ 'class' => 'source\core\grid\IdColumn' ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'width' => 'auto',
            'value' => function ($model, $key, $index, $column) {
                return str_repeat(Constants::TabSize, $model->level).Html::a($model->name, [
                        'menu/update',
                        'id' => $model->id,
                    ]);
            },
        ],
        [
            'attribute' => 'url',
            'width' => '300px',
        ],
        [
            'class' => 'source\core\grid\CenterColumn',
            'attribute' => 'targetText',
            'width' => '80px',
        ],
        [ 'class' => 'source\core\grid\SortColumn' ],
        [ 'class' => 'source\core\grid\StatusColumn' ],
        [
            'class' => 'source\core\grid\ActionColumn',
            'queryParams' => ['view' => ['category' => $category]],
        ],
    ],
]);
\yii\widgets\Pjax::end();