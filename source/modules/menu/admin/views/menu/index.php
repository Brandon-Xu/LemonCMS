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
$this->addBreadcrumbs([
    ['菜单管理', ['menu']], [$categoryModel['name'], ['menu/index', 'category' => $category]], $this->title,
]);

?>

<?php $this->toolbars([
    Html::a('返回', ['menu-category'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
    Html::a('新建', ['create', 'category' => $category], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]); ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider, //'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'source\core\grid\IdColumn',
        ], [
            'attribute' => 'name', 'format' => 'html', 'width' => 'auto',
            'value' => function ($model, $key, $index, $column) {
                return str_repeat(Constants::TabSize, $model->level).Html::a($model->name, ['menu/update', 'id' => $model->id]);
            },
        ], [
            'attribute' => 'url', 'width' => '250px',
        ], [
            'class' => 'source\core\grid\CenterColumn', 'attribute' => 'targetText', 'width' => '50px',
        ], [
            'class' => 'source\core\grid\SortColumn',
        ], [
            'class' => 'source\core\grid\StatusColumn',
        ],

        [
            'class' => 'source\core\grid\ActionColumn', 'queryParams' => ['view' => ['category' => $category]],
        ],
    ],
]); ?>

                 
