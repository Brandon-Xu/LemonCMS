<?php

use source\core\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $model source\models\TaxonomyCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $this->toolbars([
    Html::a('返回', ['index'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]); ?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'id')->textInput(['maxlength' => 64, 'readonly' => $model->isNewRecord ? NULL : 'readonly']) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

<?= $form->field($model, 'description')->textarea(['maxlength' => 512]) ?>


<?php ActiveForm::end(); ?>