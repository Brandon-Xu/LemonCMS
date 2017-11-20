<?php

use source\core\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this source\core\base\BaseView */


?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'taxonomy')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>


<?php ActiveForm::end(); ?>