<?php

use source\core\widgets\ActiveForm;
use source\modules\rbac\models\Permission;
use source\modules\rbac\rules\Rule;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\rbac\models\Permission */
/* @var $form yii\widgets\ActiveForm */

?>

<?php $this->toolbar = [
    Html::a('返回', ['index'], ['class' => 'btn btn-default']),
]; ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'id')->textInput(['maxlength' => 64]) ?>

<?= $form->field($model, 'category')->dropDownList(Permission::getCategoryItems()) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

<?= $form->field($model, 'form')->radioList(Permission::getFormItems()) ?>

<?= $form->field($model, 'default_value')->textarea() ?>

<?= $form->field($model, 'description')->textarea() ?>

<?= $form->field($model, 'rule')->dropDownList(Rule::getRules()) ?>

<?= $form->field($model, 'sort_num')->textInput() ?>



<?php ActiveForm::end(); ?>