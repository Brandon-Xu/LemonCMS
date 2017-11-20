<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\rbac\models\Role */

$this->title = '修改角色: '.' '.$model->name;
$this->params['breadcrumbs'][] = [
    'label' => '角色管理', 'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
