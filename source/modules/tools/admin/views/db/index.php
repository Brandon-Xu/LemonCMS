<?php

use source\core\widgets\ActiveForm;

/* @var $this source\core\front\FrontView */
/* @var $generator yii\gii\generators\module\Generator */

$this->title = '数据库管理';

?>

<?php $form = ActiveForm::begin(); ?>


<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>