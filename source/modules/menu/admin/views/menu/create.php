<?php

use source\LuLu;
use source\modules\menu\models\MenuCategory;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model source\modules\menu\models\Menu */

$category=LuLu::getGetValue('category');
$categoryModel = MenuCategory::findOne(['id'=>$category]);

$this->title = '新建菜单项';
$this->addBreadcrumbs([
		['菜单管理',['/menu']],
		[$categoryModel['name'],['/menu/default/index','category'=>$category]],
		$this->title,
		]);
?>

<?= $this->render('_form', [
        'model' => $model,
    ]) ?>