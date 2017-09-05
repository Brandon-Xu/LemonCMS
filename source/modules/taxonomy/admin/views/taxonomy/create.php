<?php

use source\core\lib\Common;
use source\LuLu;
use source\modules\taxonomy\models\TaxonomyCategory;


/* @var $this source\core\front\FrontView */
/* @var $model source\modules\taxonomy\models\Taxonomy */
$category = app()->request->get('category');

$this->title = '新建分类项';

$category = app()->request->get('category');
$categoryModel = TaxonomyCategory::findOne(['id' => $category]);
$this->addBreadcrumbs([
    ['分类管理', ['/taxonomy']], [$categoryModel['name'], ['/taxonomy/taxonomy', 'category' => $category]], $this->title,
]);


?>
<div class="taxonomy-create">

    <?= $this->render('_form', [
        'model' => $model, 'category' => $category,
    ]) ?>

</div>
