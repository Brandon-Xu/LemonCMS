<?php

namespace source\models;

use source\core\modularity\ModuleInfo;
use source\modules\modularity\models\Modularity;
use yii\base\ErrorException;
use yii\base\Model;
use yii\base\UnknownClassException;
use yii\base\UnknownPropertyException;

/**
 * Class ConfigForm
 * @property string $belongModule
 * @package source\models
 */
abstract class ConfigForm extends Model
{

    private static $_configForms = [];

    /** @var string $_moduleId 模块名 */
    private $_moduleId;
    private $_moduleInfoClass;

    /**
     * @param $propertyName
     * @param $arguments
     * @return mixed
     * @throws UnknownPropertyException
     */
    public static final function __callStatic($propertyName, $arguments) {
        $className = static::className();
        if(!isset(self::$_configForms[$className])){
            self::$_configForms[$className] = new $className;
        }
        if(!property_exists(self::$_configForms[$className], $propertyName)){
            throw new UnknownPropertyException('不存在的关键配置项: ' . $propertyName);
        }
        return Config::get(
            $propertyName,
            self::$_configForms[$className]->getBelongModule()
        );
    }

    /**
     * @return string
     */
    public final function getBelongModule(){
        return $this->_moduleId;
    }

    /**
     * @throws UnknownClassException
     */
    public final function init(){
        $this->_init();
        if(empty($this->_moduleId)){
            throw new UnknownClassException('not set belong module, please set belongModule in your FormClass by _init() function');
        }
        $this->loadFromDb();
    }

    /**
     * 从数据库中读取数据并填充到字段中
     * @param bool $fromCache
     */
    private function loadFromDb($fromCache = FALSE){
        $items = $this->fields();
        foreach ($items as $item){
            $this->$item = Config::get($item, $this->getBelongModule(), $fromCache);
        }
    }

    /**
     * @param ModuleInfo $moduleInfo
     * @return bool
     * @throws UnknownClassException
     */
    public final function setBelongModule(ModuleInfo $moduleInfo){
        /** @var Modularity $module */
        $module = Modularity::findOne(['id'=>$moduleInfo->id]);
        if($module && $module->info !== NULL){
            $this->_moduleId = $module->info->id;
            $this->_moduleInfoClass = $module->info;
            return TRUE;
        }
        throw new UnknownClassException("Unknown Module Info Class: {$module->info->id}, or not be installed");
    }

    /**
     * @return bool
     * @throws ErrorException
     */
    public final function save(){
        foreach ($this->getAttributes() as $attribute => $label){
            $configData = [
                'id' => $attribute,
                'value' => $this->$attribute,
                'module' => $this->belongModule,
            ];
            $item = new Config();
            $item->load($configData, '');
            if( !($item->load($configData, '') && $item->save()) ){
                throw new ErrorException('config save failed');
            }
        }
        return TRUE;
    }

    /**
     * 由于本类的 init 方法不允许再做修改
     * 所以使用 _init 方法作为可重载的代替
     */
    public function _init(){ }


}
