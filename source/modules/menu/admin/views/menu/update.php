<?php

use source\modules\menu\models\MenuCategory;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\menu\models\Menu */

$category = $model->category_id;
$categoryModel = MenuCategory::findOne(['id' => $category]);

$this->title = '修改菜单项: '.' '.$model->name;
$this->addBreadcrumbs([
    ['菜单管理', ['/menu']], [$categoryModel[ 'name' ], ['/menu/default/index', 'category' => $category]], $this->title,
]);

?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>