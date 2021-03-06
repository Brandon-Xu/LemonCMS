<?php

namespace source\modules\log\models;

use source\core\base\BaseActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "lulu_log".
 *
 * @property string $id
 * @property integer $level
 * @property string $category
 * @property double $log_time
 * @property string $prefix
 * @property string $message
 */
class Log extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['level'], 'integer'], [['log_time'], 'number'], [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID', 'level' => 'Level', 'category' => '分类', 'log_time' => '时间', 'prefix' => 'IP/用户',
            'message' => '内容',
        ];
    }

}
