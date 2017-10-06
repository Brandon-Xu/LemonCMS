<?php

use source\core\widgets\ActiveForm;
use source\core\widgets\KindEditor;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = '站点信息';
$this->addBreadcrumbs([
    $this->title,
]);

$form = ActiveForm::begin([
    'options' => [
        'class' => 'da-form',
        'enctype' => 'multipart/form-data'
    ]
]); ?>
<style>
    .hint-block > img { padding: 15px 15px 0 15px; }
</style>
<?= $form->field($model, 'site_logo')->hint(\yii\helpers\Html::img('/'.$model->site_logo, ['width'=>'100']))->fileInput() ?>
<?= $form->field($model, 'site_name') ?>
<?= $form->field($model, 'site_description') ?>
<?= $form->field($model, 'site_email') ?>
<?= $form->field($model, 'lang')->dropDownList(['zh-CN' => '中文', 'en-US' => '英文']) ?>
<?= $form->field($model, 'icp') ?>
<?= $form->field($model, 'stat')->textarea() ?>
<?= $form->field($model, 'site_about', ['size' => 'large'])->widget('kucha\ueditor\UEditor',[]);?>
<?= $form->field($model, 'status')->radioList(['1' => '正常', '0' => '关闭']) ?>

<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>