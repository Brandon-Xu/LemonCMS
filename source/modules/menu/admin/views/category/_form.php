<?php

use source\core\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\menu\models\MenuCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'id')->textInput(['maxlength' => 64, 'readonly' => $model->isNewRecord ? NULL : 'readonly']) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
<?= $form->field($model, 'description')->textarea(['maxlength' => 512]) ?>
<?php ActiveForm::end(); ?>