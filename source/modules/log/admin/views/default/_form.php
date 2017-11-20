<?php

use source\core\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\log\models\Log */
/* @var $form source\core\widgets\ActiveForm */
?>

<?php $this->toolbar = [
    Html::a('返回', ['index'], ['class' => 'btn btn-default']),
]; ?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'level')->textInput() ?>

<?= $form->field($model, 'category')->textInput(['maxlength' => TRUE]) ?>

<?= $form->field($model, 'log_time')->textInput() ?>

<?= $form->field($model, 'prefix')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>



<?php ActiveForm::end(); ?>

