<?php

namespace source\modules\log\home;

class HomeModule extends \source\core\modularity\HomeModule
{

    public $controllerNamespace = 'source\modules\log\home\controllers';

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

    //public function getMenus()
    //{
    //    return [
    //        //['首页',['/log']],
    //        //['设置',['/log/setting']],
    //    ];
    //}
}
