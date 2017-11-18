<?php

use source\core\widgets\ActiveForm;
use source\modules\fragment\models\Fragment;
use yii\helpers\Html;

/* @var $this \source\core\front\FrontView */
/* @var $model source\modules\fragment\models\FragmentCategory */
/* @var $form source\core\widgets\ActiveForm */
?>

<?php $this->toolbars([
    Html::a('返回', ['index'], ['class' => 'btn btn-xs btn-primary mod-site-save']),
]); ?>


<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

<?php if ($model->isNewRecord): ?>
    <?= $form->field($model, 'type')->radioList(Fragment::getTypeItems()) ?>
<?php else: ?>
    <?= $form->field($model, 'type')->reayOnly(Fragment::getTypeItems($model->type)) ?>
<?php endif; ?>




<?php ActiveForm::end(); ?>

