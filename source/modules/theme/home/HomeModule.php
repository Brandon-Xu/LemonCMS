<?php

namespace source\modules\theme\home;

class HomeModule extends \source\core\modularity\HomeModule
{

    public $controllerNamespace = 'source\modules\theme\home\controllers';

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

    //public function getMenus()
    //{
    //    return [
    //        //['首页',['/theme']],
    //        //['设置',['/theme/setting']],
    //    ];
    //}
}
