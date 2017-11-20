<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\models\User */

$this->title = $this->t('Update User: {user}', NULL, ['user' => $model->username]);
$this->breadcrumbs = [
    [Yii::t('app', 'User Manage'), ['index']],
    [$model->username, ['view', 'id'=>$model->id]],
    $this->title
];
$this->toolbar = [
    \yii\helpers\Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-primary']),
];

echo $this->render('_form', [
    'model' => $model,
]);