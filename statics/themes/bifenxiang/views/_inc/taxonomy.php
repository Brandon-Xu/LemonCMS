<?php

use source\LuLu;
use source\modules\taxonomy\models\Taxonomy;
use yii\helpers\Html;

/* @var $this yii\web\View */
if (isset($taxonomyId)) {
    $moduleId = app()->controller->module->id;
    $taxonomies = Taxonomy::getArrayTree($this->config()->get($taxonomyId));
    ?>

    <div class="widget d_postlist">
        <div class="title">
            <h2>分类</h2>
        </div>
        <ul>
            <li><?php echo Html::a('所有', ['/'.$moduleId.'/default/list']) ?></li>
            <?php foreach ($taxonomies as $taxonomy): ?>
                <li><?php echo Html::a($taxonomy[ 'name' ], [
                        '/'.$moduleId.'/default/list',
                        'taxonomy' => $taxonomy[ 'id' ]
                    ]) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php } ?>