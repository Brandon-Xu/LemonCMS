<?php

use source\core\widgets\ActiveForm;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = 'SEO设置';
$this->addBreadcrumbs([
    $this->title,
]);
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'seo_title'); ?>
<?= $form->field($model, 'seo_keywords') ?>
<?= $form->field($model, 'seo_description')->textarea() ?>
<?= $form->field($model, 'seo_head')->textarea() ?>
<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>
           
