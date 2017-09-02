<?php

namespace source\modules\fragment;

use source\core\modularity\ModuleService;

class FragmentService extends ModuleService
{

    public function init() {
        parent::init();
    }

    public function getServiceId() {
        return 'fragmentSerivce';
    }
}
