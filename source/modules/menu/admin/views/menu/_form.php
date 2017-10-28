<?php

use source\core\widgets\ActiveForm;
use source\libs\Constants;
use source\libs\TreeHelper;
use source\modules\menu\models\Menu;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\menu\models\Menu */
/* @var $form ActiveForm */

$category = $model->category_id;

$s = $this->menu->getTree($category);
$taxonomies = Menu::getArrayTree($category);
$options = TreeHelper::buildTreeOptionsForSelf($taxonomies, $model);

$form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $this->menu->dropDownListTree($form, $model, 'category_id', $this->menu->getTree($category, 0, FALSE)); ?>
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