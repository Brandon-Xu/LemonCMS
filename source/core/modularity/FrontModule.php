<?php

namespace source\core\modularity;

use source\core\base\BaseModule;

class FrontModule extends BaseModule
{
    public function init() {
        parent::init();
        //$this->setViewPath($this->getBasePath() . '/home/views');
    }
}
