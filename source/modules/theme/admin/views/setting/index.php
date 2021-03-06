<?php

use source\core\widgets\ActiveForm;
use source\modules\theme\models\Setting;

/* @var $this source\core\base\BaseView */
/* @var $generator yii\gii\generators\module\Generator */

$this->title = '主题设置';

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'theme_admin')->radioList(Setting::getAllAdminThemes()) ?>
<?= $form->field($model, 'theme_home')->radioList(Setting::getAllHomeThemes()) ?>


<?php ActiveForm::end(); ?>