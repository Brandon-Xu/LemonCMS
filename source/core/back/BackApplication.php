<?php

namespace source\core\back;

use source\core\base\BaseApplication;

class BackApplication extends BaseApplication
{
    public $defaultRoute = '/site/index';

    public function init() {
        parent::init();
        $this->modularityService->loadActiveModules(TRUE);
        $this->layout = 'main';
    }
}
