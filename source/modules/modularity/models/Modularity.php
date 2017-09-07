<?php

namespace source\modules\modularity\models;

use source\core\base\BaseActiveRecord;
use source\core\modularity\ModuleInfo;
use source\core\modularity\ModuleService;
use source\modules\modularity\ModularityService;
use yii\base\UnknownClassException;

/**
 * This is the model class for table "{{%modularity}}".
 *
 * @property string $id
 * @property integer $is_system
 * @property integer $is_content
 * @property integer $enable_admin
 * @property integer $enable_home
 * @property ModuleInfo $info
 * @property ModuleService $service
 */
class Modularity extends BaseActiveRecord
{

    private $_moduleClass;       // 当前环境下默认加载模块
    private $_homeModuleClass;   // home 子模块的 class 全名
    private $_adminModuleClass;  // admin 子模块的 class 全名

    /** @var ModuleInfo $_infoClass info 模块信息类*/
    private $_infoClass;
    /** @var ModuleService $_service 模块对外共享的服务类*/
    private $_service;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%modularity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'required'], [['is_system', 'is_content', 'enable_admin', 'enable_home'], 'integer'],
            [['id'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID', 'is_system' => 'Is System', 'is_content' => 'Is Content', 'enable_admin' => 'Enable Admin',
            'enable_home' => 'Enable Home',
        ];
    }

    public function afterFind() {
        parent::afterFind();
        app()->modularity->addModule($this);
    }

    /**
     * @return bool
     */
    public function hasAdminModule(){
        return $this->_adminModuleClass === FALSE ? FALSE : TRUE;
    }

    /**
     * @return bool
     */
    public function hasHomeModule(){
        return $this->_homeModuleClass === FALSE ? FALSE : TRUE;
    }

    /**
     * @return bool|string
     */
    public function getAdminModuleClass(){
        if($this->hasAdminModule()){
            return $this->_adminModuleClass;
        }
        return FALSE;
    }

    /**
     * @return bool|string
     */
    public function getHomeModuleClass(){
        if($this->hasHomeModule()){
            return $this->_homeModuleClass;
        }
        return FALSE;
    }

    /**
     * @param bool $isAdmin
     * @return string
     */
    private function getModularityTypeClass($isAdmin = FALSE){
        $className  = $isAdmin ? ModularityService::ADMIN_MODULE: ModularityService::HOME_MODULE;
        $preClass   = $isAdmin ? 'admin' : 'home';
        $class      = $preClass . '\\' . $className;
        return $class;
    }

    /**
     * 如果有对应模块则返回完整 class 名包含命名空间，否则返回 false
     * @param null $isAdmin
     * @return bool|string
     */
    public function getClass($isAdmin){

        $isAdmin = $isAdmin === TRUE ? TRUE : FALSE;
        if( empty($this->_moduleClassPullName) && (
            ($isAdmin && $this->enable_admin == 1) ||
            (!$isAdmin && $this->enable_home == 1) )
        ){  //---------
            $moduleClassName = $this->getModularityTypeClass($isAdmin);
            $moduleNamespace = app()->modularity->moduleRootNamespace;
            $class = "$moduleNamespace\\{$this->id}\\$moduleClassName";
            if(class_exists($class)){
                return $class;
            }
        }
        return FALSE;
    }

    /**
     * 用 yii 的模块系统注册 module
     */
    public function registerService(){
        $moduleNamespace = app()->modularity->moduleRootNamespace;
        $className = ucfirst($this->id).'Service';
        $class = $moduleNamespace . "\\{$this->id}\\" . $className;
        if(class_exists($class)){
            if (class_exists($class)) {
                /** @var ModuleService $serviceInstance */
                $serviceInstance = new $class();
                $this->_service = $serviceInstance->getClassName();
                // if module is already exit, just go continue
                if(!app()->has($serviceInstance->getServiceId())){
                    app()->set($serviceInstance->getServiceId(), $serviceInstance);
                }
            }
        }
    }

    /**
     * @return ModuleService|bool
     */
    public function getService(){
        if($this->_service !== NULL && is_string($this->_service)){
            return app()->get($this->_service);
        }
        return FALSE;
    }

    /**
     * @return ModuleInfo
     * @throws UnknownClassException
     */
    public function getInfo(){
        if($this->_infoClass === NULL){
            $moduleNamespace = app()->modularity->moduleRootNamespace;
            $className = ucfirst($this->id).'Info';
            $class = $moduleNamespace . "\\{$this->id}\\" . $className;
            if(class_exists($class)){
                $this->_infoClass = new $class;
            //}else{
                //throw new UnknownClassException('Can\'t find module info class, module name is: '.$className);
            }
        }
        return $this->_infoClass;
    }

    /**
     * @return bool
     */
    public function build(){
        // 设置好对应前台的后台的子模块
        if($this->enable_admin == 1){
            $this->_adminModuleClass = $this->getClass(ModularityService::ADMIN); }
        if($this->enable_home == 1){
            $this->_homeModuleClass = $this->getClass(ModularityService::HOME); }

        // 注册模块的对外服务类，如果有的话
        $this->registerService();

        // 然后根据当前环境下是前台还是后台应用来加载相应模块
        // 如果没有可用子模块直接返回 false
        $this->_moduleClass = (app()->modularity->isAdmin === TRUE) ? $this->_adminModuleClass : $this->_homeModuleClass;
        if($this->_moduleClass === FALSE) return FALSE;

        app()->setModule($this->id, [ // 加载到 yii 的模块管理中
            'class' => $this->_moduleClass,
        ]);
        return TRUE;
    }

}
