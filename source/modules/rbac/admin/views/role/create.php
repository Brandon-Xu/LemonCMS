<?php


/* @var $this source\core\front\FrontView */
/* @var $model source\modules\rbac\models\Role */

$this->title = '新建角色';
$this->params[ 'breadcrumbs' ][] = [
    'label' => '角色管理', 'url' => ['index']
];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>