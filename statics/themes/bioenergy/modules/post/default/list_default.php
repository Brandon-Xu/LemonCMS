<?php

use source\libs\Resource;
use source\modules\taxonomy\models\Taxonomy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */
$this->title = $taxonomyModel['name'];


?>

				
<?php 
$this->loopData($rows,'//_inc/content_default');
$this->showPager([
    'pagination' => $pager
]);
?>


