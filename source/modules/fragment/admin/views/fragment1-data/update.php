<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\fragment\models\Fragment1Data */

$this->title = '修改内容 '.' '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Fragment1 Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<?= $this->render('_form', [
    'model' => $model,
]) ?>
