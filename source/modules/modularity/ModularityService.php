<?php

namespace source\modules\modularity;

use source\core\modularity\ModuleService;
use source\modules\modularity\models\Modularity;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\base\UnknownClassException;

/**
 * Class ModularityService
 * @property bool $isAdmin
 * @package source\modules\modularity
 */
class ModularityService extends ModuleService implements BootstrapInterface
{

    public $backendRoute = 'admin';
    public $backendClass = 'source\modules\admin\AdminModule';

    /**
     * 用于注册 beforeRequest 事件，用于动态加载配置文件内已定义之外的模块
     * @param \yii\base\Application $app
     */
    public function bootstrap($app) {
        $app->on($app::EVENT_BEFORE_REQUEST, [$this, 'beforeRequest']);
    }

    /**
     * 不解释
     */
    public function beforeRequest() {
        // 注册自己
        app()->set('modularityService', ['class' => static::className()]);
        app()->modularity->loadSystemModule();

        list ($route, $params) = app()->getRequest()->resolve();
        $this->moduleRegisterByRoute($route, app());
    }

    /**
     * 根据路由查找是否有可用的模块化的模块，优先匹配 yii2 的模块
     * @param $route
     * @param Module $parentModule
     * @return mixed
     */
    protected function moduleRegisterByRoute($route, $parentModule) {
        if ($route === '') {
            $route = $parentModule->defaultRoute;
        }

        // double slashes or leading/ending slashes may cause substr problem
        $route = trim($route, '/');
        if (strpos($route, '//') !== FALSE) {
            return FALSE;
        }

        if (strpos($route, '/') !== FALSE) {
            list($id, $route) = explode('/', $route, 2);
        } else {
            $id = $route;
            $route = '';
        }

        if (isset($parentModule->controllerMap[$id])) {
            return TRUE;
        }

        if ($parentModule->hasModule($id)) {
            return TRUE;
        }

        if ($id === $this->backendRoute) {
            $parentModule->setModule($this->backendRoute, [
                'class' => $this->backendClass,
            ]);
            app()->modularity->isAdmin = TRUE;
            $this->moduleRegisterByRoute($route, $parentModule->getModule($id));
        }


        $modularityModel = Modularity::findOne(['id' => $id]);
        if ($modularityModel) {
            $parentModule->setModule($id, $modularityModel->build());
        }

        //$this->loadModule($id);
        return TRUE;
    }

    /** @var Modularity[] $_modules */
    private $_modules = [];
    private $_isAdmin = NULL;

    const HOME = FALSE;
    const ADMIN = TRUE;

    const ADMIN_MODULE = 'AdminModule';
    const HOME_MODULE = 'HomeModule';

    public $moduleRootNamespace = 'source\modules';

    /** @var null|Module $parentModule */
    public $parentModule = NULL;

    /**
     * @return string
     */
    public function getServiceId() {
        return 'modularityService';
    }

    /**
     * @param $value
     * @return bool
     */
    public function setIsAdmin($value) {
        if (!$value === self::ADMIN) {
            $value = self::HOME;
        }
        $this->_isAdmin = $value;

        return TRUE;
    }

    public final function getModule($moduleId) {
        return $this->getModuleById($moduleId);
    }

    public final function getModuleById($moduleId) {
        if (isset($this->_modules[$moduleId])) {
            return app()->getModules($moduleId);
        }
        throw new UnknownClassException('Unknown Module or not be installed: '.$moduleId);
    }

    /**
     * @return bool
     */
    public function getIsAdmin() {
        return $this->_isAdmin;
    }

    /**
     * @param null $isAdmin
     * @return string
     */
    public function getModularityType($isAdmin = NULL) {
        if ($isAdmin === NULL)
            $isAdmin = $this->isAdmin;

        return $isAdmin ? 'admin' : 'home';
    }

    /**
     * @return string
     */
    public function getModularityTypeClass() {
        $className = $this->isAdmin ? ModularityService::ADMIN_MODULE : ModularityService::HOME_MODULE;
        $class = $this->getModularityType().'\\'.$className;

        return $class;
    }

    /**
     * 在本类中注册模块
     * @param Modularity $module
     */
    public final function addModule(Modularity $module) {
        $moduleArray = $module->build();
        if (!isset($this->_modules[$module->id]) && is_array($moduleArray)) {
            $this->_modules[$module->id] = $moduleArray;
        }
    }

    /**
     * @param bool $onlyKeys
     * @return Modularity[]
     */
    public function getAllModules($onlyKeys = FALSE) {
        if (empty($this->_modules)) {
            $this->loadAllModules();
        }
        if ($onlyKeys === TRUE) {
            return array_keys($this->_modules);
        } else {
            return Modularity::find()->indexBy('id')->all();
        }
    }

    /**
     * 自己看方法名体会含义，身为一个程序员儿，这是基本功夫！嗯！
     * @param $moduleId
     * @return bool
     */
    public function checkModuleExists($moduleId) {
        return in_array($moduleId, $this->getAllModules(TRUE)) ? TRUE : FALSE;
    }

    public function loadModule($id) {
        return $this->loadModules([$id]);
    }

    /**
     * @param array $ids
     * @return bool
     */
    public function loadModules($ids = []) {
        $modulesList = Modularity::find()->indexBy('id');
        if (!empty($ids)) {
            $modulesList->where(['id' => $ids]);
        }
        $modulesList->all();

        return TRUE;
    }

    /**
     * @return bool
     */
    public function loadAllModules() {
        return $this->loadModules();
    }

    public function loadSystemModule() {
        Modularity::find()->where(['is_system' => 1])->indexBy('id')->all();

        return TRUE;
    }

}
