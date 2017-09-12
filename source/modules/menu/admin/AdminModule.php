<?php

namespace source\modules\menu\admin;

class AdminModule extends \source\core\modularity\AdminModule
{
    public $controllerNamespace = 'source\modules\menu\admin\controllers';

    public function init() {
        parent::init();

        $this->defaultRoute = 'menu-category';
        // custom initialization code goes here
    }
}
