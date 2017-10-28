<?php

/* @var $this source\core\front\FrontView */
/* @var $model source\modules\menu\models\MenuCategory */

$this->title = $this->t('Update menu category: {menu}', NULL, ['menu'=>$model->name]);
$this->breadcrumbs = [
    [$this->t('Menu Categories'), ['category/index']],
    $this->title,
];

echo $this->render('_form', [
    'model' => $model,
]);