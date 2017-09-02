<?php

use source\core\widgets\ActiveForm;
use source\core\widgets\KindEditor;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '站点信息';
$this->addBreadcrumbs([
    $this->title
]);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'sys_site_name') ?>
<?= $form->field($model, 'sys_site_description') ?>
<?= $form->field($model, 'sys_site_email') ?>
<?= $form->field($model, 'sys_lang')->dropDownList(['zh-CN' => '中文', 'en-US' => '英文']) ?>
<?= $form->field($model, 'sys_icp') ?>
<?= $form->field($model, 'sys_stat')->textarea() ?>
<?= $form->field($model, 'sys_site_about', ['size' => 'default'])->textarea() ?>
<?= $form->field($model, 'sys_status')->radioList(['1' => '正常', '0' => '关闭']) ?>
<?php echo KindEditor::widget(['inputId' => '#basicconfig-sys_site_about', 'width' => '70%']) ?>
<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>
           