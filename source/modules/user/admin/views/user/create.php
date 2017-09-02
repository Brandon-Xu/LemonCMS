<?php


/* @var $this yii\web\View */
/* @var $model source\models\User */

$this->title = '新建用户';
$this->params[ 'breadcrumbs' ][] = ['label' => 'Users', 'url' => ['index']];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>