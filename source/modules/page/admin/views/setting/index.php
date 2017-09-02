<?php

use source\core\widgets\ActiveForm;
use source\libs\Common;
use yii\helpers\ArrayHelper;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '单面模块设置';
$this->addBreadcrumbs([
    '基本设置',
]);

$categories = Common::getTaxonomyCategories();
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'page_taxonomy')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>

<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>
           