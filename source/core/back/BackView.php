<?php

namespace source\core\back;

use source\core\base\BaseView;
use source\libs\Resource;
use source\LuLu;
use yii\base\Theme;

class BackView extends BaseView
{

    public function init() {
        parent::init();
    }

    public function setTheme() {
        $currentTheme = Resource::getAdminTheme();

        $moduleId = app()->controller->module->id;

        $config = [
            'pathMap' => [
                '@app/views' => [
                    '@statics/admin/'.$currentTheme.'/views'
                ], '@source/modules/'.$moduleId.'/admin/views' => [
                    '@statics/admin/'.$currentTheme.'/modules/'.$moduleId
                ]
            ], 'baseUrl' => '@statics/admin/'.$currentTheme
        ];

        $this->theme = new Theme($config);
    }

    public function toolbars($bars = []) {
        LuLu::setViewParam(['toolbars' => $bars]);
    }
}
