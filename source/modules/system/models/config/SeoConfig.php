<?php

namespace source\modules\system\models\config;

use source\models\ConfigForm;
use source\modules\system\SystemInfo;

/**
 * Class SeoConfig
 * @method static string seo_title()
 * @method static string seo_keywords()
 * @method static string seo_description()
 * @method static string seo_head()
 * @package source\modules\system\models\config
 */
class SeoConfig extends ConfigForm
{

    public function _init() {
        $this->setBelongModule(new SystemInfo());
    }

    public $seo_title;
    public $seo_keywords;
    public $seo_description;
    public $seo_head;

    public function rules() {
        return [
            [['seo_title', 'seo_keywords', 'seo_description', 'seo_head'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'seo_title' => '标题',
            'seo_keywords' => '关键字',
            'seo_description' => '描述',
            'seo_head' => '其它头部信息',
        ];
    }
}
