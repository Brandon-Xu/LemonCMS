<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\log\models\Log */

$this->title = 'Update Log: '.' '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<?= $this->render('_form', [
    'model' => $model,
]) ?>
