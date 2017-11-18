<?php

use source\core\widgets\ActiveForm;
use source\libs\Constants;
use source\modules\dict\models\Dict;
use yii\helpers\Html;

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\menu\models\Menu */

$this->toolbar = [
    Html::a(Yii::t('app', 'Back'), ['index', 'category' => $model->category_id], ['class' => 'btn btn-warning']),
];
$form = ActiveForm::begin();

echo $form->field($model, 'parent_id')->dropDownListTree(Dict::find()->getTree($model->category_id, 0));
echo $form->field($model, 'name')->textInput();
echo $form->field($model, 'value')->textarea();
echo $form->field($model, 'thumb')->textInput();
echo $form->field($model, 'description')->textarea();
echo $form->field($model, 'sort_num')->textInput();
echo $form->field($model, 'status')->radioList(Constants::getStatusItems());

ActiveForm::end();

