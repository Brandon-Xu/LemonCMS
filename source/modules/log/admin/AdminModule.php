<?php

namespace source\modules\log\admin;


class AdminModule extends \source\core\modularity\AdminModule
{

    public $controllerNamespace = 'source\modules\log\admin\controllers';

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

    //public function getMenus()
    //{
    //    return [
    //        ['首页',['/log']],
    //        ['设置',['/log/setting']],
    //    ];
    //}
}
