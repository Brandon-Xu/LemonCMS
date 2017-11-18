<?php

/* @var $this source\core\front\FrontView */
/* @var $model \source\modules\dict\models\Dict */

$this->title = $this->t('Update Dictionary: {name}', NULL, ['name'=>$model->name]);

$this->breadcrumbs = [
    [$this->t('Dictionary Manage'), ['dict-category/']],
    [$model->category->name, ['index', 'category'=>$model->category->id]],
    $model->name
];

echo $this->render('_form', [
    'model' => $model,
]);