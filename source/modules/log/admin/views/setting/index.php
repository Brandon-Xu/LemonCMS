<?php

use source\core\grid\GridView;
use source\core\widgets\ActiveForm;
use source\libs\Common;
use source\libs\Constants;
use source\LuLu;
use source\modules\log\models\Setting;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this source\core\back\BackView */


?>

<?php  $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'post_taxonomy')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>
   
    <?=  $form->defaultButtons() ?>
<?php  ActiveForm::end(); ?>