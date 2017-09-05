<?php

namespace backend\controllers;

use source\core\back\BackController;
use source\LuLu;

class SiteController extends BackController
{

    public function actionIndex() {
        $this->layout = 'container';

        return $this->render('index');
    }

    public function actionWelcome() {
        return $this->render('welcome');
    }

    public function actionTest() {
        return $this->render('welcome');
    }

    public function actionLogout() {
        app()->user->logout();

        return $this->redirect([
            'index',
        ]);
    }

    public function actionLogin() {
        if (!LuLu::$app->user->isGuest) {
            return $this->goHome();
        }
        $message = '';
        $this->layout = FALSE;
        $model = new \source\models\LoginForm();
        if ($model->load(LuLu::$app->request->post())) {
            if ($model->login()) {
                if (app()->rbac->checkPermission('manager_admin')) {
                    return $this->goBack();
                } else {
                    app()->user->logout();
                    $message = '您没有权限登录管理系统';
                    LuLu::error("用户名：{$model->username}，密码：{$model->password}，{$message}", '登录后台');
                }
            } else {
                LuLu::error("用户名：{$model->username}，密码：{$model->password}，{$message}", '登录后台');
            }
        }

        return $this->render('login', [
            'model' => $model, 'message' => $message,
        ]);
    }
}
