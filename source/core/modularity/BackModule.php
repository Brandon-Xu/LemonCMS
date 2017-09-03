<?php

namespace source\core\modularity;

use source\core\base\BaseModule;

class BackModule extends BaseModule
{
    public function init() {
        parent::init();
        //$this->setViewPath($this->getBasePath() . '/admin/views');
    }
}
