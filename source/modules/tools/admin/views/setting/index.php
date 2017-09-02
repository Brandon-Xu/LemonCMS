<?php

use source\core\widgets\ActiveForm;
use source\libs\Common;
use source\LuLu;
use source\modules\tools\models\Setting;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $generator yii\gii\generators\module\Generator */


?>

<?php  $form = ActiveForm::begin(); ?>

    <?=  $form->field($model, 'post_taxonomy')->dropDownList(ArrayHelper::map($categories, 'id', 'name')) ?>
   
    <?=  $form->defaultButtons() ?>
<?php  ActiveForm::end(); ?>