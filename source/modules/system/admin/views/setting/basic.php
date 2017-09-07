<?php

use source\core\widgets\ActiveForm;
use source\core\widgets\KindEditor;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '站点信息';
$this->addBreadcrumbs([
    $this->title,
]);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'site_name') ?>
<?= $form->field($model, 'site_description') ?>
<?= $form->field($model, 'site_email') ?>
<?= $form->field($model, 'lang')->dropDownList(['zh-CN' => '中文', 'en-US' => '英文']) ?>
<?= $form->field($model, 'icp') ?>
<?= $form->field($model, 'stat')->textarea() ?>
<?= $form->field($model, 'site_about', ['size' => 'default'])->textarea() ?>
<?= $form->field($model, 'status')->radioList(['1' => '正常', '0' => '关闭']) ?>
<?php echo KindEditor::widget(['inputId' => '#basicconfig-sys_site_about', 'width' => '70%']) ?>
<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>
           