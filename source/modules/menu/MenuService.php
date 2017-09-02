<?php

namespace source\modules\menu;

use source\core\modularity\ModuleService;
use source\modules\menu\models\Menu;

class MenuService extends ModuleService
{

    public function getServiceId() {
        return 'menuService';
    }

    public static function getChildren($category, $parentId = 0, $status = NULL) {
        return Menu::getChildren($category, $parentId, $status = NULL);
    }

    public static function getMenuHtml($category, $parentId) {
        return Menu::getMenuHtml($category, 0);
    }
}
