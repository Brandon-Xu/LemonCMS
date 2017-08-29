<?php
namespace source\modules\user\home;

use source\core\modularity\FrontModule;

class HomeModule extends FrontModule
{
    public $controllerNamespace = 'source\modules\user\home\controllers';

    public function init(){
        parent::init();
        // custom initialization code goes here
    }

}
