<?php

use \source\core\base\BaseApplication;
use source\libs\Common;

// comment out the following two lines when deployed to production
define('__WEB_DIR__', dirname(__DIR__));

defined('YII_DEBUG') or define('YII_DEBUG', TRUE);
defined('YII_ENV') or define('YII_ENV', 'prod');

require (__WEB_DIR__ . '/vendor/autoload.php');
require (__WEB_DIR__ . '/vendor/yiisoft/yii2/Yii.php');
require (__WEB_DIR__ . '/data/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__WEB_DIR__ . '/data/config/main.php'),
    require(__WEB_DIR__ . '/data/config/main-local.php')
);

Common::checkInstall($config);
(new BaseApplication($config))->run();