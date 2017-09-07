<?php

namespace source\core\front;

use source\core\base\BaseApplication;
use source\models\Config;

class FrontApplication extends BaseApplication
{

    public function init() {
        if(Config::get('status') === '0') {
            app()->catchAll = ['site/close', 'message' => 'test'];
        }
        parent::init();
    }

}