<?php

namespace source\modules\modularity;

use source\core\modularity\ModuleInfo;

class ModularityInfo extends ModuleInfo
{

    public function init() {
        parent::init();

        $this->id = 'modularity';
        $this->name = '模块管理';
        $this->version = '1.0';
        $this->description = '用来对系统中的模块进行管理';

        $this->is_system = TRUE;
    }
}
