<?php

namespace source\modules\tools\models;

use yii\base\Model;

class CacheForm extends Model
{

    public $cache;
    public $asset;

    public function rules() {
        return [
            [['cache', 'asset'], 'boolean'], [['test1', 'test2'], 'string', 'max' => 64],
        ];
    }


    public function attributeLabels() {
        return [
            'cache' => '清空缓存',
            'asset' => '清空Asset',
        ];
    }
}
