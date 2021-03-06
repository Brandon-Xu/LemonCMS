<?php

use source\modules\menu\models\MenuCategory;


/* @var $this source\core\base\BaseView */
/* @var $model source\modules\menu\models\Menu */

$category = app()->request->get('category');
$categoryModel = MenuCategory::findOne(['id' => $category]);

$this->title = $this->t('Create new menu');
$this->breadcrumbs = [
    [$this->t('Menu Categories'), ['category/index']],
    [$categoryModel['name'], ['menu/index', 'category' => $category]],
    $this->title,
];

echo $this->render('_form', [
    'model' => $model,
]);