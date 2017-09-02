<?php


/* @var $this source\core\front\FrontView */
/* @var $model source\modules\menu\models\MenuCategory */


$this->title = '新建菜单';
$this->addBreadcrumbs([
    ['菜单管理', ['/menu']], $this->title,
]);

?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>