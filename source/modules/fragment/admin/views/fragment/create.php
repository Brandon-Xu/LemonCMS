<?php


/* @var $this source\core\front\FrontView */
/* @var $model source\modules\fragment\models\Fragment */

$this->title = '新建碎片';
$this->params['breadcrumbs'][] = ['label' => 'Fragments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
