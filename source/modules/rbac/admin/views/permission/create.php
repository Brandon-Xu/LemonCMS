<?php


/* @var $this source\core\front\FrontView */
/* @var $model source\modules\rbac\models\Permission */

$this->title = '新建权限';
$this->params[ 'breadcrumbs' ][] = [
    'label' => '权限管理', 'url' => ['index']
];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>