<?php

namespace source\modules\modularity;

use source\core\modularity\ModuleService;
use source\modules\modularity\models\Modularity;

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
     * @param Modularity $module
     */
    public function addModule(Modularity $module){
        if(!isset($this->_modules[$module->id]) && $module->build()){
            $this->_modules[$module->id] = $module;
        }
    }

    /**
     * @return Modularity[]
     */
    public function getAllModules() {
        if(empty($this->_modules)){
            $this->loadActiveModules();
        }
        return $this->_modules;
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
