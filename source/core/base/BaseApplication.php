<?php

namespace source\core\base;

use source\libs\Common;
use source\models\Config;
use source\traits\Theme;
use yii\web\Application;

class BaseApplication extends Application
{

    use \source\traits\Common;
    use Theme;

    public $defaultRoute = 'site';

    public function init() {
        parent::init();
        $this->modularity->isAdmin = FALSE;
        $this->modularity->loadAllModules();
        Common::setTimezone();

        if(Config::get('status') === '0') {
            app()->catchAll = ['site/close', 'message' => 'test'];
        }
    }

    public function handleRequest($request) {
        /*
        * copy 自 createController 方法中的代码，根据 url 获取其中的 module 模块名
        * 然后尝试引入模块，如果模块存在并成功引入，则会自动执行模块中的 init() 方法
        * 以达到在模块文件中通过 init 方法另行设置各类不得不在请求被 handle 之前设置的模块参数
        * 例如 urlManager 里的 Rules 的目的，而不需要在配置文件里就写完所有 url 规则
        */
        $loadModuleAndRunInit = function ($route) {
            $id = $route;
            if (strpos($route, '/') !== FALSE) {
                list ($id, $route) = explode('/', $route, 2); }
            return $this->getModule($id);
        };

        list ($route, $params) = $request->resolve();
        $loadModuleAndRunInit($route);
        return parent::handleRequest($request);
    }

    /**
     * 实现 Theme Traits 里规定必须实现的 beforeAction 事件方法
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action) {
        $this->setTheme();
        return parent::beforeAction($action);
    }
}
