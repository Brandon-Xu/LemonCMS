<?php

// 正常人不要理会这个文件！！这个只是方便阿婆主自己用的而已！！
$db = file_exists(__DIR__ . '/local-db.php') ? require(__DIR__.'/local-db.php') : require(__DIR__.'/db.php');
// 正常人可以用这行来引入数据库配置！！，注释掉上面那行！
//$db = require(__DIR__.'/db.php');

$params = array_merge(
    require(__DIR__.'/params.php'),
    require(__DIR__.'/params-local.php')
);

return [
    'id' => 'home',
    'language' => 'zh-CN',
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)).'/vendor',
    'runtimePath' => dirname(dirname(__DIR__)).'/data/runtime',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'source\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => FALSE,
        ],
        'request' => [
            //'enableCsrfValidation' => FALSE,
            'cookieValidationKey' => '41SCN-vryMrrUOuOzXXcGo0GP4zBgMhr',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'view' => [
            'class' => 'source\core\front\FrontView',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@data/cache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'schemaCache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@data/cache',
            'keyPrefix' => 'scheme_'
        ],
        'security' => [
            'class' => 'yii\base\Security',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'db' => $db
        ],
        'assetManager' => [
            'basePath' => '@assets',
            'baseUrl' => '@web/assets',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
            ],
            //'linkAssets' => true,
        ],
        'urlManager' => [
            //'class' => 'source\core\base\UrlManager',
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => TRUE,
            'showScriptName' => FALSE,
            'enableStrictParsing' => FALSE,
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.sina.com',
                'username' => 'xxx@sina.com',
                'password' => "xxx",
                'port' => '25',
                //'port'=>'465',
                //'encryption' => 'ssl',
            ],
            'useFileTransport' => FALSE,
            'messageConfig' => [
                'from' => ['xxx@sina.com' => 'Admin'],
                'charset' => 'UTF-8',
            ],
        ],
        'db' => $db,
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'file' => [
                    'class' => 'source\modules\log\DbTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ],
                    //'categories' => ['yii\'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => [
                        'error', 'warning',
                    ],
                ],
            ],
        ],
        'modularityService' => [
            'class' => 'source\modules\modularity\ModularityService',
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'source\modules\admin\AdminModule',
        ],
        'install' => [
            'class' => 'source\modules\install\home\HomeModule',
        ],
    ],
    'params' => $params,
];
