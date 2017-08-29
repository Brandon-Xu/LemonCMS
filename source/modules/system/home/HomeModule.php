<?php
namespace source\modules\system\home;

use source\core\modularity\FrontModule;

class HomeModule extends FrontModule
{
    public $controllerNamespace = 'source\modules\system\home\controllers';
    public function init(){
        parent::init();
        // custom initialization code goes here
    }

}
