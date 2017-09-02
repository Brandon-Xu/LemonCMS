<?php

/* @var $this source\core\front\FrontView */
/* @var $model source\models\TaxonomyCategory */

$this->title = '修改: '.' '.$model->name;

$this->addBreadcrumbs([
    ['分类管理', ['/taxonomy']], $this->title,
]);


?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>
