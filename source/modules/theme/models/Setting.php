<?php

namespace source\modules\theme\models;

use source\models\ConfigForm;
use source\modules\theme\ThemeInfo;

class Setting extends ConfigForm
{

    public $theme_home;
    public $theme_admin;

    public function _init() {
        $this->setBelongModule(new ThemeInfo);
    }

    public function rules() {
        return [
            [['theme_home', 'theme_admin'], 'required'],
            [['theme_home', 'theme_admin'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels() {
        return [
            'theme_home' => '前台主题', 'theme_admin' => '后台主题',
        ];
    }

    public static function getAllHomeThemes() {
        $items = [
            'bifenxiang' => '博客主题bifenxiang',
            'fengyun' => '博客主题fengyun',
            'bioenergy' => '企业主题',
            'CodingLife' => 'CodingLife',
        ];

        return $items;
    }

    public static function getAllAdminThemes() {
        $items = [
            'dandelion' => 'dandelion',
        ];

        return $items;
    }
}
