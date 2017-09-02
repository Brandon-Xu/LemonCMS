<?php

use source\core\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this source\core\back\BackView */


?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'post_taxonomy')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>

<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>