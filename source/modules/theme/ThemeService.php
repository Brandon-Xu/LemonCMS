<?php

namespace source\modules\theme;

use source\core\modularity\ModuleService;

class ThemeService extends ModuleService
{

    public function init() {
        parent::init();
    }

    public function getServiceId() {
        return 'themeSerivce';
    }
}
