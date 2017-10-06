<?php

namespace frontend\controllers;

use source\core\base\BaseController;
use source\models\ContactForm;
use source\models\User;
use yii\filters\Cors;

app()->end();

class SiteController extends BaseController
{

    public function behaviors() {
        return [
            [
                'class' => Cors::className(),
                'cors' => [
                    'Access-Control-Request-Method' => [ 'GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS', ],
                ],
                'actions' => [
                    'app' => [
                        'Access-Control-Allow-Credentials' => TRUE,
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index', []);
    }

    public function actionLogin() {
        if (!\app()->user->isGuest) {
            return $this->goHome();
        }
        $model = new User();
        $model->scenario = 'login';
        if ($model->load(app()->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout() {
        app()->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        //$this->layout=false;
        $model = new ContactForm();
        if ($model->load(app()->request->post()) && $model->contact(app()->params['adminEmail'])) {
            app()->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout() {
        return $this->render('about', [
            'test' => 5, 'testData' => $this->testData,
        ]);
    }

    public function actionClose() {
        return $this->render('close', [
            'message' => '站点维护中。。。',
        ]);
    }

    public function actionGuestbook() {
        return $this->render('guestbook', []);
    }

}
