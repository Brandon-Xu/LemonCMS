<?php

use source\core\widgets\ActiveForm;
use source\libs\Constants;
use yii\helpers\ArrayHelper;

/* @var $this source\core\base\BaseView */
/* @var $model source\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput([
    'maxlength' => 255, 'readonly' => $model->isNewRecord ? NULL : 'readonly',
]) ?>

<?= $form->field($model, 'password')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

<?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(app()->rbac->getAllRoles(), 'id', 'name', 'category')) ?>

<?= $form->field($model, 'status')->radioList(Constants::getStatusItems()) ?>



<?php ActiveForm::end(); ?>