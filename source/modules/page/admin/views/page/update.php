<?php

/* @var $this source\core\front\FrontView */
/* @var $model source\models\Content */


$this->title = '修改页面';
$this->params[ 'breadcrumbs' ][] = ['label' => '文章管理', 'url' => ['index']];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model, 'bodyModel' => $bodyModel,
]) ?>