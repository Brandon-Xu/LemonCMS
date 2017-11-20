<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\models\Content */


$this->title = $this->t('Update post: {title}', NULL, ['title'=>$model->title]);
$this->breadcrumbs = [
    [$this->t('Post Manage'), ['index']],
    $this->title
];
echo $this->render('_form', [
    'model' => $model
]);