<?php

namespace source\modules\theme;

use source\core\modularity\ModuleInfo;

class ThemeInfo extends ModuleInfo
{

    public function init() {
        parent::init();

        $this->id = 'theme';
        $this->name = '主题模块';
        $this->version = '1.0';
        $this->description = '用来设置前台和后台主题';

        $this->is_system = TRUE;
    }
}
