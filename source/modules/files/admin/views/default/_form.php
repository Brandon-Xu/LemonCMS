<?php

use yii\helpers\Html;
use source\core\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model source\modules\files\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'driver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'basename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uploaderId')->textInput() ?>

    <?= $form->field($model, 'basePath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'absUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?php ActiveForm::end(); ?>

</div>
