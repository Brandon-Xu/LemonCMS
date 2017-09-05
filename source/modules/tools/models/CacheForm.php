<?php

namespace source\modules\tools\models;

use source\core\base\BaseModel;

class CacheForm extends BaseModel
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
