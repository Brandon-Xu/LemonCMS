<?php

use source\core\widgets\ActiveForm;
use source\libs\Common;
use yii\helpers\ArrayHelper;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '单面模块设置';
$this->breadcrumbs = [
    '基本设置',
];

$categories = $this->taxonomy->getTaxonomyCategories();
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'taxonomy')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>

<?php ActiveForm::end(); ?>