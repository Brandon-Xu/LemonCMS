<?php

use source\core\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = 'SEO设置';
$this->addBreadcrumbs([
    $this->title
]);
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'sys_seo_title'); ?>
<?= $form->field($model, 'sys_seo_keywords') ?>
<?= $form->field($model, 'sys_seo_description')->textarea() ?>
<?= $form->field($model, 'sys_seo_head')->textarea() ?>
<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>
           
