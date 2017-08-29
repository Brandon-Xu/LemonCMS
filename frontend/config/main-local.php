<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nttN49BkYzUIiCrceNFctxIWK33-uLAF',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => TRUE,
            'showScriptName' => FALSE,
            'rules' => [

            ],
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config[ 'bootstrap' ][] = 'debug';
    $config[ 'modules' ][ 'debug' ] = 'yii\debug\Module';

    $config[ 'bootstrap' ][] = 'gii';
    $config[ 'modules' ][ 'gii' ] = 'yii\gii\Module';
}

return $config;