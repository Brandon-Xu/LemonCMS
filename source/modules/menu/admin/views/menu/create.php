<?php

use source\LuLu;
use source\modules\menu\models\MenuCategory;


/* @var $this source\core\front\FrontView */
/* @var $model source\modules\menu\models\Menu */

$category = app()->request->get('category');
$categoryModel = MenuCategory::findOne(['id' => $category]);

$this->title = '新建菜单项';
$this->addBreadcrumbs([
    ['菜单管理', ['/menu']], [$categoryModel['name'], ['/menu/default/index', 'category' => $category]], $this->title,
]);
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>