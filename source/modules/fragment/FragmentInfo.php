<?php

namespace source\modules\fragment;

use source\core\modularity\ModuleInfo;

class FragmentInfo extends ModuleInfo
{

    public function init() {
        parent::init();

        $this->id = 'fragment';
        $this->name = '碎片模块';
        $this->version = '1.0';
        $this->description = '常用的代码片段';

        $this->is_system = TRUE;
    }
}
