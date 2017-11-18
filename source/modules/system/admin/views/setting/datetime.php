<?php

use source\core\widgets\ActiveForm;
use source\modules\system\models\config\DatetimeConfig;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '时间设置';
$this->addBreadcrumbs([
    $this->title,
]);
?>


<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'datetime_timezone')->dropDownList(DatetimeConfig::getTimezones()); ?>
<?= $form->field($model, 'datetime_date_format') ?>
<?= $form->field($model, 'datetime_time_format')->radioList(['24' => '24 小时制', '12' => '12 小时制', '0' => '不显示时间']) ?>
<?= $form->field($model, 'datetime_pretty_format')->radioList(['1' => '是', '0' => '否']) ?>

<?php ActiveForm::end(); ?>
           
