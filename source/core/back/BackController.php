<?php

namespace source\core\back;

use source\LuLu;
use source\core\base\BaseController;
use source\core\rbac\AuthorRule;
use yii\web\ForbiddenHttpException;

class BackController extends BaseController
{

    public function beforeAction($action) {

        if (!parent::beforeAction($action)) {
            return FALSE;
        }

        return parent::beforeAction($action);
        /*
        $module = $action->controller->module->id;
        $moduleInfo = '后台';
        try { $moduleInfo = app()->modularity->getModule($module)->info->name;
        }catch (\Exception $e){}
        $moduleInfo .= '管理';
        $controller = $action->controller->id; //获取到控制器
        $actionName = $action->id; //获取到action

        //验证权限
        $access = "{$module}/{$controller}";  //权限name

        $rbac = app()->modularity->rbac;

        if($action->controller->module->id == app()->id && $action->controller->id == 'site'){
            return parent::beforeAction($action);
        }

        if(!app()->user->can($this->action->id)){
            throw new ForbiddenHttpException('权限不足');
        }

        $admin = $rbac->addRole('administrator', '超级管理员');
        $manager = $rbac->addRole('manager', '管理员');
        $editor = $rbac->addRole('editor', '编辑');
        $rbac->addRole('guest', '访客');
        $rbac->addRule(AuthorRule::className());
        $upown = $rbac->addPermission('updateOwnContent', '只允许修改自己新增的内容', AuthorRule::className());

        $rbac->addChild($editor, 'updateOwnContent');
        $rbac->addChild($admin, $editor);
        $rbac->addChild($admin, $manager);
        $rbac->addChild($manager, $editor);

        $actionLabel = [
            'index' => '列表',
            'view' => '详情',
            'create' => '创建',
            'update' => '更新',
            'delete' => '删除'
        ];
        $rbac->addPermission($access, $moduleInfo);
        if (isset($actionLabel[$actionName])){
            $rbac->addPermission($actionName, $actionLabel[$actionName]);
            $rbac->addChild($actionName, $access);
            if($actionName == 'update'){
                $rbac->addChild($upown, $actionName);
            }
        }
        //$rbac->assign($admin, app()->user->id);
        //$rbac->assign($access, app()->user->id);
        */


        //检查不需要登录的action uniqueID,如 site/login, site/captcha
        if (in_array(app()->controller->uniqueId.'/'.$action->id, $this->ignoreLogin()) || $action->id == 'upload') {
            return parent::beforeAction($action);
        }

        if (\Yii::$app->user->isGuest) {
            LuLu::go(['/admin/site/login']);
        }

        if (!app()->rbac->checkPermission('manager_admin')) {
            return $this->showMessage();
        }

        if (in_array($action->uniqueID, $this->ingorePermission())) {
            return parent::beforeAction($action);
        }

        if (!app()->rbac->checkPermission()) {
            return $this->showMessage();
        } else {
            return parent::beforeAction($action);
        }
        //return TRUE;
    }

    public function ignoreLogin() {
        return [
            'admin/site/login',
            'admin/site/captcha',
        ];
    }

    public function ingorePermission() {
        return [
            'admin/site/logout',
            'admin/site/error',
            'admin/site/welcome',
            'admin/site/index',
            'admin/post/post/UEDUpload',
            'admin/post/post/upload'
        ];
    }

    public function showMessage($message = NULL, $title = 'Hint', $params = []) {
        if ($message === NULL) {
            $message = \Yii::t('app', 'Permission denied');
        }
        $params = array_merge([
            'title' => \Yii::t('app', $title),
            'message' => $message,
        ], $params);
        echo $this->render('@activeTheme/views/site/message', $params);app()->end();
    }
}
