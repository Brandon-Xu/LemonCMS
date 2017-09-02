<?php

use source\core\widgets\LinkPager;
use source\core\widgets\ListView;
use source\core\widgets\LoopData;
use source\libs\DataSource;
use source\libs\Resource;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this source\core\front\FrontView */

$this->layout = 'main';
$this->title='首页';

$locals = DataSource::getPagedContents();
?>

<?php 

        $this->loopData($locals['rows'],'//_inc/content_default');
        $this->showWidget('LinkPager', [
            'pagination' => $locals['pager']
        ]);
        
        ?>
        
