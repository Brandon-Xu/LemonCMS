<?php

namespace source\modules\tools\home;

class HomeModule extends \source\core\modularity\HomeModule
{

    public $controllerNamespace = 'source\modules\tools\home\controllers';

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

    //public function getMenus()
    //{
    //    return [
    //        //['首页',['/tools']],
    //        //['设置',['/tools/setting']],
    //    ];
    //}
}
