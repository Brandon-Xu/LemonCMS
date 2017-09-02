<?php

use source\core\widgets\ActiveForm;
use source\libs\Constants;
use source\modules\rbac\models\Role;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model source\modules\rbac\models\Role */
/* @var $form yii\widgets\ActiveForm */

?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => 64,'readonly'=>$model->isNewRecord ? false : true]) ?>

    <?= $form->field($model, 'category')->dropDownList(Role::getCategoryItems()) ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->defaultButtons() ?>

    <?php ActiveForm::end(); ?>