<?php

namespace source\modules\comment\admin;

use source\core\modularity\BackModule;

class AdminModule extends BackModule
{
    public $controllerNamespace = 'source\modules\comment\admin\controllers';

    public function init() {
        parent::init();
        // custom initialization code goes here
    }
}
