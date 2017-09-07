<?php

namespace source\modules\system\models\config;

use source\models\ConfigForm;
use source\modules\system\SystemInfo;

class AccessConfig extends ConfigForm
{


    public function _init() {
        $this->setBelongModule(new SystemInfo());
    }

    public $allow_register;
    public $default_role;


    public function rules() {
        return [
            [['default_role'], 'string'],
            [['allow_register'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [

            'allow_register' => '允许注册',
            'default_role' => '用户默认角色',

        ];
    }
}


