<?php

use source\libs\Resource;
use source\modules\taxonomy\models\Taxonomy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this source\core\front\FrontView */

$this->title = $taxonomyModel['name'];

?>

<?php if(!empty($taxonomyModel->id)):?>
<div id="myposts">
    <h3 class="myposts_title">当前分类: <?php echo $taxonomyModel->name ?></h3>
</div>

<?php endif;?>
				
<?php 
$this->loopData($rows,'//_inc/content_default');
$this->showPager([
    'pagination' => $pager
]);
?>


