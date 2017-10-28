<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model source\modules\files\models\search\FileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'driver') ?>

    <?= $form->field($model, 'filename') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'basename') ?>

    <?php // echo $form->field($model, 'extension') ?>

    <?php // echo $form->field($model, 'uploaderId') ?>

    <?php // echo $form->field($model, 'basePath') ?>

    <?php // echo $form->field($model, 'absUrl') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
