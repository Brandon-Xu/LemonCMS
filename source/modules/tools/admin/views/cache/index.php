<?php

use source\core\widgets\ActiveForm;

/* @var $this source\core\base\BaseView */
/* @var $generator yii\gii\generators\module\Generator */

$this->title = '缓存管理';

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'cache')->checkbox([], FALSE) ?>
<?= $form->field($model, 'asset')->checkbox([], FALSE) ?>


<?php ActiveForm::end(); ?>