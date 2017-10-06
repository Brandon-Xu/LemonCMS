<?php

namespace source\modules\dict\admin;

class AdminModule extends \source\core\modularity\AdminModule
{

    public $controllerNamespace = 'source\modules\dict\admin\controllers';

    public function init() {
        parent::init();
        $this->defaultRoute = 'dict-category';
    }

}
