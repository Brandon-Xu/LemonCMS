<?php

use source\core\widgets\ActiveForm;
use source\LuLu;
use source\modules\fragment\models\FragmentCategory;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\fragment\models\Fragment */
/* @var $form source\core\widgets\ActiveForm */

$type = app()->request->get('type');

?>

<?php $this->toolbar = [
    Html::a('返回', ['index', 'type' => $type], ['class' => 'btn btn-default']),
]; ?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'code')->textInput(['maxlength' => 63]) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 63]) ?>
<?= $form->field($model, 'category_id')->dropDownList(FragmentCategory::getCategories($type)) ?>

<?= $form->field($model, 'description')->textarea(['maxlength' => 256]) ?>



<?php ActiveForm::end(); ?>


