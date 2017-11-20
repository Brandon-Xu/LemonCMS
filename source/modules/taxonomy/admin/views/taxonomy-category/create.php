<?php


/* @var $this source\core\base\BaseView */
/* @var $model source\models\TaxonomyCategory */

$this->title = '新建分类';
$this->breadcrumbs = [
    ['分类管理', ['/taxonomy']], $this->title,
];


?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>