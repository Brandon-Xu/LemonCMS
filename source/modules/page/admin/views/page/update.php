<?php

/* @var $this source\core\base\BaseView */
/* @var $model source\models\Content */


$this->title = 'Update Page';

$this->breadcrumbs = [
    ['Page Manage', ['index']],
    $model->title,
    $this->title
];

echo $this->render('_form', [
    'model' => $model
]);