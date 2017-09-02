<?php

use source\core\grid\GridView;
use source\libs\Common;
use source\libs\Constants;
use source\libs\Resource;
use source\LuLu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\helpers\Url;


/* @var $this source\core\back\BackView */
/* @var $model source\modules\log\models\Log */

$this->title = 'Create Log';
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
