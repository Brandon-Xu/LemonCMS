<?php

namespace source\modules\page\home;

use source\core\modularity\FrontModule;

class HomeModule extends FrontModule
{

    public $controllerNamespace = 'source\modules\page\home\controllers';

    public function init() {
        parent::init();
        // custom initialization code goes here
    }
}
