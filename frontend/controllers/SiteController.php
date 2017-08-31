<?php

namespace frontend\controllers;

use yii\filters\Cors;
use source\core\front\FrontController;

class SiteController extends FrontController
{

    public $enableCsrfValidation = FALSE;

    public function behaviors() {
        return [
            [
                'class' => Cors::className(),
                'cors' => [
                    //定义允许来源的数组
                    'Access-Control-Request-Method' => [
                        'GET',
                        'POST',
                        'PUT',
                        'DELETE',
                        'HEAD',
                        'OPTIONS'
                    ],
                    //允许动作的数组
                ],
                'actions' => [
                    'app' => [
                        'Access-Control-Allow-Credentials' => TRUE,
                    ]
                ]
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

}
