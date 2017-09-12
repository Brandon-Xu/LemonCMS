<?php

use source\core\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */
$this->title = '文章模块设置';
$this->addBreadcrumbs([
    '基本设置',
]);
$categories = $this->taxonomy->getTaxonomyCategories();
$form = ActiveForm::begin(); ?>
<?= $form->field($model, 'taxonomy')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>
<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>
           