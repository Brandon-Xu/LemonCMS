<?php

namespace source\modules\files\admin;

class AdminModule extends \source\core\modularity\AdminModule
{

    public $controllerNamespace = 'source\modules\files\admin\controllers';

    public function init() {
        parent::init();
        $this->defaultRoute = 'default/index';
    }

}
