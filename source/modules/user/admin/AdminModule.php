<?php

namespace source\modules\user\admin;

class AdminModule extends \source\core\modularity\AdminModule
{
    public $controllerNamespace = 'source\modules\user\admin\controllers';

    public function init() {
        parent::init();
        $this->defaultRoute = 'user';
    }
}
