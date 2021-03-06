<?php

use source\core\widgets\ActiveForm;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = 'SEO设置';
$this->breadcrumbs = [
    $this->title,
];
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'seo_title'); ?>
<?= $form->field($model, 'seo_keywords') ?>
<?= $form->field($model, 'seo_description')->textarea() ?>
<?= $form->field($model, 'seo_head')->textarea() ?>

<?php ActiveForm::end(); ?>
           
