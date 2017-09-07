<?php

namespace source\core\base;

use source\LuLu;
use yii\base\Module;

class BaseModule extends Module
{

    const Status_Installed = 'Installed';

    const Status_Uninstalled = 'Uninstalled';

    const Status_Activity = 'Activity';

    const Status_Inactivity = 'Inactivity';

    public $status;

    public $moduleInfo;

    public function init() {
        parent::init();
    }

    public function getMenus() {
        return [];
    }

    public function config(){

    }

    public function getRoutings() { }

    public function getPermissions() {
        $permissions = [
            [
                'key' => 'create', 'title' => 'create post', 'description' => 'create a new post',
            ],
        ];

        return $permissions;
    }

}
