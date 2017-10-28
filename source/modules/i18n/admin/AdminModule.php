<?php

namespace source\modules\i18n\admin;

class AdminModule extends \source\core\modularity\AdminModule
{

    public $controllerNamespace = 'source\modules\i18n\admin\controllers';

    public function init() {
        parent::init();
        $this->defaultRoute = 'source/index';
    }

}
