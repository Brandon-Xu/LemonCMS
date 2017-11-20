<?php


/* @var $this source\core\base\BaseView */
/* @var $model source\modules\menu\models\MenuCategory */


$this->title = $this->t('Create menu category');
$this->breadcrumbs = [
    [$this->t('Menu Categories'), ['category/index']],
    $this->title,
];

echo $this->render('_form', [
    'model' => $model,
]);