<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\fragment\models\search\FragmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fragment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'], 'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
