<?php

namespace source\modules\system\models\config;

use source\libs\Common;
use source\models\ConfigForm;
use source\modules\system\SystemInfo;

class BasicConfig extends ConfigForm
{

    public function _init() {
        $this->setBelongModule(new SystemInfo());
    }

    public $site_logo;
    public $site_name;
    public $site_description;
    public $site_about;
    public $site_url;
    public $site_email;

    public $lang;
    public $icp;
    public $stat;

    public $status;


    public function rules() {
        return [
            [['site_logo', 'site_name', 'site_description', 'site_about', 'site_url', 'lang', 'icp', 'stat', ], 'string'],
            [['site_email'], 'email'],
            [['status'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'site_logo' => '网站logo',
            'site_name' => '网站名称',
            'site_description' => '网站描述',
            'site_about' => '关于',
            'site_email' => '站点Email',
            'lang' => '站点语言',
            'icp' => '备案号',
            'stat' => '统计代码',
            'status' => '站点状态',
        ];
    }

}
