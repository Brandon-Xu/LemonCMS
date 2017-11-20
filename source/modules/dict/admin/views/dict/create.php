<?php

/* @var $this source\core\base\BaseView */
/* @var $model \source\modules\dict\models\Dict */

$this->title = $this->t('Create Dictionary');

$this->breadcrumbs = [
    [$this->t('Dictionary Manage'), ['index']],
    $this->title
];

echo $this->render('_form', [
    'model' => $model,
]);