<?php

namespace source\modules\modularity;

use source\core\modularity\ModuleService;
use source\modules\modularity\models\Modularity;
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
        if($this->getIsAdmin() !== NULL) return TRUE;
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

    /**
     * 在本类中注册模块
     * @param Modularity $module
     */
    public final function addModule(Modularity $module){
        if(!isset($this->_modules[$module->id]) && $module->build()){
            $this->_modules[$module->id] = $module;
        }
    }

    /**
     * @param bool $onlyKeys
     * @return Modularity[]
     */
    public function getAllModules($onlyKeys = FALSE) {
        if(empty($this->_modules)){
            $this->loadActiveModules();
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
    public function loadActiveModules(){
        $field = $this->isAdmin ? 'enable_admin' : 'enable_home';
        Modularity::find()->where([
            $field => 1,
        ])->indexBy('id')->all();
        return TRUE;
    }

}
