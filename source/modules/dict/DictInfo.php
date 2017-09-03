<?php

namespace source\modules\dict;

use source\core\modularity\ModuleInfo;

class DictInfo extends ModuleInfo
{

    public function init() {
        parent::init();

        $this->id = 'dict';
        $this->name = '字典模块';
        $this->version = '1.0';
        $this->description = '常用的数据，如 省市数据';

        $this->is_system = TRUE;
    }
}
