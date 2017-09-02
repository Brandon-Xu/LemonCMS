<?php


/* @var $this source\core\front\FrontView */
/* @var $model source\models\DictCategory */

$this->title = '新建分类';
$this->params['breadcrumbs'][] = ['label' => 'Dict Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>