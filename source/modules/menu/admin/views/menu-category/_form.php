<?php

use source\core\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model source\modules\menu\models\MenuCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $this->toolbars([
    Html::a('返回', ['index'], ['class' => 'btn btn-xs btn-primary mod-site-save'])
]);?>

<?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id')->textInput(['maxlength' => 64,'readonly'=>$model->isNewRecord?null:'readonly'])?>
    
        <?= $form->field($model, 'name')->textInput(['maxlength' => 64])?>
    
        <?= $form->field($model, 'description')->textarea(['maxlength' => 512])?>

    <?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>