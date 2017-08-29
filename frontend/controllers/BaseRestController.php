<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/8/13
 * Time: 22:44
 */

namespace frontend\controllers;

use yii\rest\ActiveController;
use yii\web\Response;

class BaseRestController extends ActiveController
{

    public function init() {
        parent::init();
        header('Access-Control-Allow-Origin:*');
        app()->response->on('beforeSend', function ($e) {
            $response = $e->sender;
            if ($response->data !== NULL) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'data' => ($response->isSuccessful) ? $response->data : $response->data,
                    'code' => $response->statusCode,
                ];
                $response->statusCode = 200;
            }
        });
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors[ 'contentNegotiator' ][ 'formats' ] = ['application/json' => Response::FORMAT_JSON];

        return $behaviors;
    }

    protected function verbs() {
        return [
            'index' => [ 'GET', 'HEAD' ],
            'view' => [ 'GET', 'HEAD' ],
            'create' => ['POST'],
            'update' => [ 'PUT', 'PATCH' ],
            'delete' => [ 'DELETE' ],
        ];
    }

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

}