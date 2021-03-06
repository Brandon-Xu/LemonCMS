<?php

use source\core\widgets\ActiveForm;
use source\modules\rbac\models\Role;
use yii\helpers\ArrayHelper;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '注册与访问控制';
$this->breadcrumbs = [
    $this->title,
];
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'allow_register')->checkbox([], FALSE) ?>
<?= $form->field($model, 'default_role')->dropDownList(ArrayHelper::map(Role::buildOptions(), 'id', 'name', 'category')) ?>

<?php ActiveForm::end(); ?>
