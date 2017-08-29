<?php

namespace source\core\back;

use source\core\base\BaseController;
use source\LuLu;

class BackController extends BaseController
{
    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return FALSE;
        }

        //检查不需要登录的action uniqueID,如 site/login, site/captcha
        if (in_array($action->uniqueID, $this->ignoreLogin())) {
            return parent::beforeAction($action);
        }

        if (\Yii::$app->user->isGuest) {
            LuLu::go(['/site/login']);
        }

        if (!$this->rbacService->checkPermission('manager_admin')) {
            return $this->showMessage();
        }

        if (in_array($action->uniqueID, $this->ingorePermission())) {
            return parent::beforeAction($action);
        }

        if (!$this->rbacService->checkPermission()) {
            return $this->showMessage();
        } else {
            return parent::beforeAction($action);
        }
    }

    public function ignoreLogin() {
        return [
            'site/login',
            'site/captcha',
        ];
    }

    public function ingorePermission() {
        return [
            'site/logout',
            'site/error',
            'site/welcome',
            'site/index',
        ];
    }

    public function showMessage($message = NULL, $title = '提示', $params = []) {
        if ($message === NULL) {
            $message = '权限不足，无法进行此项操作';
        }
        $params = array_merge([
            'title' => $title,
            'message' => $message
        ], $params);

        return $this->render('//site/message', $params);
    }
}
