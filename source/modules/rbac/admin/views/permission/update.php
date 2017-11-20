<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\rbac\models\Permission */

$this->title = '修改权限: '.' '.$model->name;
$this->params['breadcrumbs'][] = [
    'label' => '权限管理', 'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>