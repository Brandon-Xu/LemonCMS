<?php


/* @var $this source\core\front\FrontView */
/* @var $model source\models\Content */

$this->title = '新建页面';
$this->params[ 'breadcrumbs' ][] = ['label' => '页面管理', 'url' => ['index']];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model, 'bodyModel' => $bodyModel,
]) ?>