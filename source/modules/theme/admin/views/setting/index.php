<?php

use source\core\widgets\ActiveForm;
use source\modules\theme\models\Setting;

/* @var $this source\core\front\FrontView */
/* @var $generator yii\gii\generators\module\Generator */

$this->title = '主题设置';

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'sys_theme_admin')->radioList(Setting::getAllAdminThemes()) ?>
<?= $form->field($model, 'sys_theme_home')->radioList(Setting::getAllHomeThemes()) ?>

<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>