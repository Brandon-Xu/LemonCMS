<?php

namespace source\modules\theme;

class ThemeService extends \source\core\modularity\ModuleService
{

    public function init() {
        parent::init();
    }

    public function getServiceId() {
        return 'themeSerivce';
    }
}
