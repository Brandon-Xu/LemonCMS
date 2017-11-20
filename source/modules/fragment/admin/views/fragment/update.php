<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\fragment\models\Fragment */

$this->title = '修改碎片: '.' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Fragments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<?= $this->render('_form', [
    'model' => $model,
]) ?>
