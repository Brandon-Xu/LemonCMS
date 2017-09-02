<?php

namespace source\models;

use source\LuLu;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $id
 * @property string $value
 */
class Config extends \source\core\base\BaseActiveRecord
{
    const CachePrefix = 'config_';

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
        return [[['id'], 'required'], [['value'], 'string'], [['id'], 'string', 'max' => 64]];
    }

    public static function getAttributeLabels($attribute = NULL) {
        $items = ['id' => '名称', 'value' => '值'];

        return ArrayHelper::getItems($items, $attribute);
    }

    public static function getModel($id, $fromCache = TRUE) {
        $cacheKey = self::CachePrefix.$id;

        $value = $fromCache ? LuLu::getCache($cacheKey) : FALSE;

        if ($value === FALSE) {
            $value = Config::findOne(['id' => $id]);
            if ($value !== NULL) {
                LuLu::setCache($cacheKey, $value);
            }
        }

        return $value;
    }

    public static function getValue($id, $fromCache = TRUE) {
        $value = self::getModel($id, $fromCache);
        if ($value === NULL) {
            return '不存在配置项：'.$id;
        }

        return $value->value;
    }

    public static function clearCachedConfig($id) {
        $cacheKey = self::CachePrefix.$id;
        LuLu::deleteCache($cacheKey);
    }

    public function clearCache() {
        self::clearCachedConfig($this->id);
    }
}
