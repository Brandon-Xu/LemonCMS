<?php

date_default_timezone_set('PRC');

// 正常人不要理会这个文件！！这个只是方便阿婆主自己用的而已！！
$db = file_exists(__DIR__ . '/local-db.php') ? require(__DIR__.'/local-db.php') : require(__DIR__.'/db.php');

// 正常人可以用这行来引入数据库配置！！，注释掉上面那行！
//$db = require(__DIR__.'/db.php');


return [
    'vendorPath' => dirname(dirname(__DIR__)).'/vendor',
    'runtimePath' => dirname(dirname(__DIR__)).'/data/runtime',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@data/cache',
        ],
        'schemaCache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@data/cache',
            'keyPrefix' => 'scheme_'
        ],
        'security' => [
            'class' => 'source\core\base\Security',
        ],
        'assetManager' => [
            'basePath' => '@webroot/statics/assets',
            'baseUrl' => '@web/statics/assets',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => []
                ],
                // you can override AssetBundle configs here
            ],
            //'linkAssets' => true,
            // ...
        ],
        'urlManager' => [
            'class' => 'source\core\base\UrlManager',
            'enablePrettyUrl' => TRUE,
            'showScriptName' => TRUE,
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
            'targets' => [
                'file' => [
                    'class' => 'source\modules\log\DbTarget',
                    'levels' => [
                        'error',
                        'warning'
                    ],
                    //'categories' => ['yii\'],
                ],

            ],
        ],
        'modularityService' => [
            'class' => 'source\modules\modularity\ModularityService',
        ],
    ],
];
