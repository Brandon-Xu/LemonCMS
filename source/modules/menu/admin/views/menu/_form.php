<?php

use source\core\widgets\ActiveForm;
use source\libs\Constants;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\menu\models\Menu */
/* @var $form ActiveForm */

$form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'parent_id')->dropDownListTree($this->menu->getTree($model->category_id, 0, FALSE)); ?>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'icon')->fontAwesomeList(); ?>
        <?= $form->field($model, 'description')->textInput() ?>
        <?= $form->field($model, 'url')->textInput() ?>
        <?= $form->field($model, 'target')->radioList(Constants::getTargetItems()) ?>
        <?= $form->field($model, 'status')->radioList(Constants::getStatusItems()) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'sort_num')->textInput() ?>
        <?= $form->field($model, 'thumb')->fileInput() ?>
    </div>

<?php ActiveForm::end();