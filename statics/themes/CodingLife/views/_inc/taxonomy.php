<?php

use source\libs\Resource;
use source\LuLu;
use source\models\Content;
use source\modules\taxonomy\models\Taxonomy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;


/* @var $this yii\web\View */


$moduleId = app()->controller->module->id;

$taxonomies = LuLu::getService('taxonomy')->getTaxonomiesAsTree($this->getConfigValue($moduleId.'_taxonomy'));

if(!empty($taxonomies))
{
    
?>
<div class="sidebar-block">
    <h3 class="catListTitle">分类</h3>
    <div>
        <ul>
            <li><?php echo Html::a('所有',['/'.$moduleId.'/default/list'])?></li>
            <?php foreach ($taxonomies as $taxonomy):?>
            <li><?php echo Html::a($taxonomy['name'],['/'.$moduleId.'/default/list','taxonomy'=>$taxonomy['id']])?></li>
            <?php endforeach;?>

        </ul>
        <div class="clear"></div>
    </div>
</div>
    
<?php }?>