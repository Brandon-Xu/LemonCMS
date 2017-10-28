<?php

namespace source\models;

use Yii;
use source\core\base\BaseActiveRecord;
use source\modules\system\SystemInfo;
use yii\base\InvalidParamException;
use yii\base\UnknownPropertyException;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property integer $num_id
 * @property string $id
 * @property string $value
 * @property string $module
 */
class Config extends BaseActiveRecord
{

    const CachePrefix = 'config_';

    public $duration = 0;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'module'], 'required'],
            [['value'], 'string'],
            [['module'], 'string', 'max' => 20],
            [['id',], 'string', 'max' => 64],
            [['module'], 'checkModuleExists'],
            [['id', 'module'], 'unique', 'targetAttribute' => ['id', 'module'],
             'message' => 'The combination of ID and Module has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'num_id' => Yii::t('app', 'ID'),
            'id' => Yii::t('app', 'key'),
            'value' => Yii::t('app', 'value'),
            'module' => Yii::t('app', 'Module'),
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function checkModuleExists($attribute, $params){
        if (app()->modularity->checkModuleExists($this->$attribute) === FALSE){
            $this->addError($attribute, 'Unknown module ID!');
            throw new InvalidParamException('Unknown module ID:' . $this->$attribute);
        }
    }

    /**
     * 给喜欢尽可能明确一点的人一个机会！
     * @param $id
     * @param bool $fromCache
     * @return mixed
     */
    public static function getSystemConfig($id, $fromCache = TRUE){
        return static::getValueById($id, NULL, $fromCache);
    }

    /**
     * 只是提供一个简写的方法
     * @param $id
     * @param null $moduleId
     * @param bool $fromCache
     * @return mixed
     */
    public static function get($id, $moduleId = NULL, $fromCache = TRUE){
        return static::getValueById($id, $moduleId, $fromCache);
    }

    /**
     * @param $id
     * @param $moduleId
     * @param bool $fromCache
     * @return mixed
     */
    public static function getValueById($id, $moduleId = NULL, $fromCache = TRUE){
        if($moduleId === NULL) $moduleId = SystemInfo::getId();
        $item = new static();
        $item->id = $id;
        $item->module = $moduleId;
        return $item->getValue($fromCache);
    }

    /**
     * @return string
     */
    private function getCacheId(){
        return self::CachePrefix . $this->module . '_' . $this->id;
    }

    /**
     * @param bool $fromCache
     * @return bool|mixed
     * @throws UnknownPropertyException
     */
    private function getValue($fromCache = TRUE){
        if(empty($this->id)) throw new InvalidParamException('config id is required');
        //$this->checkModuleExists('module', $this->module);

        $cacheId = $this->getCacheId();
        $value = app()->cache->get($cacheId);


        if ($fromCache === TRUE && $value !== FALSE){
            $value = is_object($value) ? $value->value : $value;
        }else{
            $fromCache = FALSE;
        }

        if($fromCache === FALSE){
            $item = static::findOne(['id'=>$this->id, 'module'=>$this->module]);
            if($item){
                $item->addToCache();
                return $item->value;
            }
            throw new UnknownPropertyException('Can\'t find the config item: '. $this->id. ':: module: '.$this->module);
        }

        return $value;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) {
        $this->addToCache();
        parent::afterSave($insert, $changedAttributes);
    }

    protected function addToCache() {
        $key = $this->getCacheId();
        $value = $this->value;
        $duration = $this->duration;
        $result = app()->cache->set($key, $value, $duration, NULL);
        if ($result === FALSE) {
            \Yii::getLogger()->log('cache save failed', 'error');
        }
    }

    /**
     * 删除配置项的时候也把缓存删了
     * @return bool
     */
    public function beforeDelete() {
        $this->clean();
        return parent::beforeDelete();
    }

    public function clean(){
        app()->cache->delete($this->getCacheId());
    }
}
