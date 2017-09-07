<?php

namespace source\modules\system\models\config;

use source\models\ConfigForm;
use source\modules\system\SystemInfo;

class ThemeConfig extends ConfigForm
{
    public function _init() {
        $this->setBelongModule(new SystemInfo());
    }

    public $site_theme;
    public $test_data_theme;

    public function rules() {
        return [
            [['site_theme', 'test_data_theme'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'site_theme' => '主题',
            'test_data_theme' => '测试',
        ];
    }
}
