<?php


/* @var $this source\core\front\FrontView */
/* @var $model source\models\Content */

$this->title = $this->t('Create Post');
$this->breadcrumbs = [
    [$this->t('Post Manage'), ['index']],
    $this->title
];

echo $this->render('_form', [
    'model' => $model
]);