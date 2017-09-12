<?php

use source\libs\Resource;
use source\models\Content;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this yii\web\View */

?>

<li><?php echo Html::a($row['title'],$row['url'])?></li>

