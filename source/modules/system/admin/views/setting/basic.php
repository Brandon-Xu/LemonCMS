<?php

use source\core\widgets\ActiveForm;
use source\core\widgets\KindEditor;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '站点信息';
$this->breadcrumbs = [
    $this->title,
];

$form = ActiveForm::begin(); ?>

<?= $form->field($model, 'site_logo')->fileInput() ?>
<?= $form->field($model, 'site_name') ?>
<?= $form->field($model, 'site_description') ?>
<?= $form->field($model, 'site_email') ?>
<?= $form->field($model, 'lang')->dropDownList(['zh-CN' => '中文', 'en-US' => '英文']) ?>
<?= $form->field($model, 'icp') ?>
<?= $form->field($model, 'stat')->textarea() ?>
<?= $form->field($model, 'site_about')->widget('source\assets\UEditor');?>
<?= $form->field($model, 'status')->radioList(['1' => '正常', '0' => '关闭']) ?>

<?php ActiveForm::end(); ?>