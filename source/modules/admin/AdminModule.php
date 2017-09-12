<?php

namespace source\modules\admin;

class AdminModule extends \source\core\modularity\AdminModule
{

    public $id = 'admin';
    public $defaultRoute = 'site/index';
    public $controllerNamespace = 'source\modules\admin\controllers';

    public function init() {
        parent::init();
        app()->catchAll = NULL; // 清除在 BaseApplication 里设置的网站关闭拦截防止后台也被一块儿无差别干掉 ㄟ( ▔, ▔ )ㄏ
        app()->modularity->isAdmin = TRUE;
        app()->modularity->parentModule = $this;
        app()->modularity->loadAllModules();
    }
}