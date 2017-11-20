<?php


/* @var $this source\core\base\BaseView */
/* @var $model source\models\Content */

$this->title = $this->t('Create Post');
$this->breadcrumbs = [
    [$this->t('Post Manage'), ['index']],
    $this->title
];

echo $this->render('_form', [
    'model' => $model
]);