<?php

use source\core\widgets\LinkPager;
use source\libs\DataSource;
use source\libs\Resource;
use source\modules\taxonomy\models\Taxonomy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this source\core\front\FrontView */
$this->title = '页面';


?>


<?php 
$this->loopData($rows,'//_inc/content_default');
$this->showPager([
    'pagination' => $pager
]);
?>


