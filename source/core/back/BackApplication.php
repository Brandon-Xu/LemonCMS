<?php

namespace source\core\back;

use source\core\base\BaseApplication;

class BackApplication extends BaseApplication
{
    public function init() {
        parent::init();
        $this->loadActiveModules(TRUE);
        $this->layout = 'main';
    }
}
