<?php

use source\core\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model source\modules\system\models\config\BasicConfig */
/* @var $form ActiveForm */

$this->title = 'Email 设置';
$this->addBreadcrumbs([
    $this->title
]);
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->defaultButtons() ?>
<?php ActiveForm::end(); ?>
           
                    