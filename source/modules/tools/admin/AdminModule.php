<?php

namespace source\modules\tools\admin;

class AdminModule extends \source\core\modularity\AdminModule
{

    public $controllerNamespace = 'source\modules\tools\admin\controllers';

    public function init() {
        parent::init();

        // custom initialization code goes here
    }

    //public function getMenus()
    //{
    //    return [
    //        ['首页',['/tools']],
    //        ['设置',['/tools/setting']],
    //    ];
    //}
}
