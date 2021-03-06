<?php

use source\modules\taxonomy\models\TaxonomyCategory;

/* @var $this source\core\base\BaseView */
/* @var $model source\modules\taxonomy\models\Taxonomy */

$category = $model['category_id'];

$this->title = '更新分类项: '.$model->name;

$categoryModel = TaxonomyCategory::findOne(['id' => $category]);
$this->breadcrumbs = [
    ['分类管理', ['/taxonomy']], [$categoryModel['name'], ['/taxonomy/taxonomy', 'category' => $category]], $this->title,
];


?>
<div class="taxonomy-update">

    <?= $this->render('_form', [
        'model' => $model, 'category' => $category,
    ]) ?>

</div>
