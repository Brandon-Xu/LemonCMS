<?php

namespace source\models;

use source\core\base\BaseActiveRecord;
use source\modules\system\SystemInfo;
use yii\base\InvalidParamException;
use yii\base\UnknownPropertyException;
use yii\caching\DbQueryDependency;

/**
 * This is the model class for table "{{%config}}".
 *
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

    public function attributeLabels() {
        return [
            'id' => '名称',
            'value' => '值',
            'module' => '所属模块',
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
        return self::CachePrefix . $this->id;
    }

    /**
     * @param bool $fromCache
     * @return bool|mixed
     * @throws UnknownPropertyException
     */
    private function getValue($fromCache = TRUE){
        if(empty($this->id)) throw new InvalidParamException('config id is required');
        $this->checkModuleExists('module', $this->module);

        $value = FALSE;
        $cacheId = $this->getCacheId();
        if ($fromCache === TRUE && ($value = app()->cache->get($cacheId)) !== FALSE){
            $value = is_object($value) ? $value->value : $value;
        }

        if($fromCache === FALSE || $value === FALSE){
            $item = static::findOne(['id'=>$this->id, 'module'=>$this->module]);
            if($item){
                return $item->value;
            }
            throw new UnknownPropertyException('Can\'t find the config item: '. $this->id);
        }

        return $value;
    }

    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public final function save($runValidation = TRUE, $attributeNames = NULL) {
        if ($this->isNewRecord){
            $item = $this::findOne(['id'=>$this->id, 'module'=>$this->module]);
            if ($item){
                $item->value = $this->value;
                return $item->save();
            }
        }
        return parent::save(TRUE, NULL);
    }

    /**
     * 在 save 动作后执行，如果是新的配置项则新建一个 cache 并建立与 sql 语句的关联
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) {
        $key = $this->getCacheId();
        $value = $this->value;
        $duration = $this->duration;
        if ($this->isNewRecord) {
            if (app()->cache->exists($key)){ app()->cache->delete($key); }
            $dependency = new DbQueryDependency([
                'query' => self::find()->select('value')->where(['id' => $this->id, 'module' => $this->module]),
            ]); // 添加至 yii 的 cache 组件
            $result = app()->cache->add($key, $value, $duration, $dependency);
            if ($result === FALSE){
                \Yii::getLogger()->log('cache save failed', 'error');
            }
        }
        parent::afterSave($insert, $changedAttributes);
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
