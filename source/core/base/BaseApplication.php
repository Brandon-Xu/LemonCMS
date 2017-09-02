<?php

namespace source\core\base;

use source\core\modularity\ModuleService;
use source\libs\Common;
use source\LuLu;
use source\traits\CommonTrait;
use yii\helpers\FileHelper;
use yii\web\Application;

/**
 *
 * @property \source\modules\modularity\ModularityService $modularityService
 * @property \source\modules\rbac\RbacService $rbacService
 * @property \source\modules\taxonomy\TaxonomyService $taxonomyService
 * @property \source\modules\menu\MenuService $menuService
 *
 */
class BaseApplication extends Application
{
    use CommonTrait;

    public $activeModules = [];

    public function init() {
        parent::init();
        Common::setTimezone();
    }

    public function loadActiveModules($isAdmin) {
        $moduleManager = $this->modularityService;

        $this->activeModules = $moduleManager->getActiveModules($isAdmin);

        $module = $isAdmin ? 'admin\AdminModule' : 'home\HomeModule';

        foreach ($this->activeModules as $m) {
            $moduleId = $m['id'];
            $moduleDir = $m['dir'];
            $ModuleClassName = $m['dir_class'];

            $this->setModule($moduleId, [
                'class' => 'source\modules\\'.$moduleDir.'\\'.$module,
            ]);

            $serviceFile = LuLu::getAlias('@source').'\modules\\'.$moduleDir.'\\'.$ModuleClassName.'Service.php';
            if (FileHelper::exist($serviceFile)) {
                $serviceClass = 'source\modules\\'.$moduleDir.'\\'.$ModuleClassName.'Service';
                /** @var ModuleService $serviceInstance */
                $serviceInstance = new $serviceClass();
                $this->set($serviceInstance->getServiceId(), $serviceInstance);
            }
        }
    }

    public function handleRequest($request) {

        /*
        * @todo 如果以后要开源出去的话这块得在文档里写一下
        * copy 自 createController 方法中的代码，根据 url 获取其中的 module 模块名
        * 然后尝试引入模块，如果模块存在并成功引入，则会自动执行模块中的 init() 方法
        * 以达到在模块文件中另行添加 urlManager 里的 Rules 的目的，而不需要在配置文
        * 件里就写完所有 url 规则
        */
        list ($route, $params) = $request->resolve();
        $loadModuleAndRunInit = function ($route) {
            if (strpos($route, '/') !== FALSE) {
                list ($id, $route) = explode('/', $route, 2);
            } else {
                $id = $route;
                $route = '';
            }

            return $this->getModule($id);
        };
        $loadModuleAndRunInit($route);

        return parent::handleRequest($request);
    }
}
