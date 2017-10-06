<?php

namespace source\modules\taxonomy\admin;

class AdminModule extends \source\core\modularity\AdminModule
{

    public $controllerNamespace = 'source\modules\taxonomy\admin\controllers';

    public function init() {
        parent::init();
        $this->defaultRoute = 'taxonomy-category';
    }

}
