<?php

use source\core\widgets\ActiveForm;
use source\modules\fragment\models\Fragment;
use yii\helpers\Html;

/* @var $this \source\core\base\BaseView */
/* @var $model source\modules\fragment\models\FragmentCategory */
/* @var $form source\core\widgets\ActiveForm */
?>

<?php $this->toolbar = [
    Html::a('返回', ['index'], ['class' => 'btn btn-default']),
]; ?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput() ?>

<?php if ($model->isNewRecord):
    echo $form->field($model, 'type')->radioList(Fragment::getTypeItems());
else:
    echo $form->field($model, 'type')->reayOnly(Fragment::getTypeItems($model->type));
endif;

ActiveForm::end(); ?>

