<?php

namespace source\modules\modularity;

use source\core\modularity\ModuleService;
use source\modules\modularity\models\Modularity;
use yii\base\Module;
use yii\base\UnknownClassException;

/**
 * Class ModularityService
 * @property bool $isAdmin
 * @package source\modules\modularity
 */
class ModularityService extends ModuleService
{
    /** @var Modularity[] $_modules */
    private $_modules = [];
    private $_isAdmin = NULL;

    const HOME  = FALSE;
    const ADMIN = TRUE;

    const ADMIN_MODULE = 'AdminModule';
    const HOME_MODULE  = 'HomeModule';

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
    public function setIsAdmin($value){
        if(!$value === self::ADMIN){
            $value = self::HOME;
        }
        $this->_isAdmin = $value;
        return TRUE;
    }

    public final function getModule($moduleId){
        return $this->getModuleById($moduleId);
    }

    public final function getModuleById($moduleId){
        if(isset($this->_modules[$moduleId])){
            return $this->_modules[$moduleId];
        }
        throw new UnknownClassException('Unknown Module or not be installed: ' . $moduleId);
    }

    /**
     * @return bool
     */
    public function getIsAdmin(){
        return $this->_isAdmin;
    }

    /**
     * @param null $isAdmin
     * @return string
     */
    public function getModularityType($isAdmin = NULL) {
        if($isAdmin === NULL) $isAdmin = $this->isAdmin;
        return $isAdmin ? 'admin' : 'home';
    }

    /**
     * @return string
     */
    public function getModularityTypeClass(){
        $className  = $this->isAdmin ? ModularityService::ADMIN_MODULE: ModularityService::HOME_MODULE;
        $class      = $this->getModularityType() . '\\' . $className;
        return $class;
    }

    public function setModule($id, $module){
        if($this->parentModule !== NULL){
            $this->parentModule->setModule($id, $module);
        }
        app()->setModule($id, $module);
    }

    /**
     * 在本类中注册模块
     * @param Modularity $module
     */
    public final function addModule(Modularity $module){
        $moduleArray = $module->build();
        if(!isset($this->_modules[$module->id]) && is_array($moduleArray)){
            $this->_modules[$module->id] = $module;
            $this->setModule($module->id, $moduleArray);
        }
    }

    /**
     * @param bool $onlyKeys
     * @return Modularity[]
     */
    public function getAllModules($onlyKeys = FALSE) {
        if(empty($this->_modules)){
            $this->loadAllModules();
        }
        if($onlyKeys === TRUE){
            return array_keys($this->_modules);
        }
        return $this->_modules;
    }

    /**
     * 自己看方法名体会含义，身为一个程序员儿，这是基本功夫！嗯！
     * @param $moduleId
     * @return bool
     */
    public function checkModuleExists($moduleId){
        return in_array($moduleId, $this->getAllModules(TRUE)) ? TRUE : FALSE;
    }

    /**
     * @return bool
     */
    public function loadAllModules(){
        if(!empty($this->_modules)){
            foreach ($this->_modules as $module => $c) {
                app()->setModule($module, NULL);
            }
            $this->_modules = [];
        }
        Modularity::find()->indexBy('id')->all();
        return TRUE;
    }
}
