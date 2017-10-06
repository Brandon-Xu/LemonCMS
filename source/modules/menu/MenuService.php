<?php

namespace source\modules\menu;

use source\core\modularity\ModuleService;
use source\modules\menu\models\Menu;

class MenuService extends ModuleService
{

    public function getServiceId() {
        return 'menuService';
    }

    public static function getChildren($category, $parentId = 0, $status = NULL, $fromCache = TRUE) {
        return Menu::getChildren($category, $parentId, $status = NULL, $fromCache);
    }

    public static function getMenuHtml($category, $parentId) {
        return Menu::getMenuHtml($category, 0);
    }

    /**
     * @param null $categoryId
     * @param int $parentId
     * @param bool $asArray
     * @return Menu[]
     */
    public function getTree($categoryId = NULL, $parentId = 0, $asArray = TRUE){
        $query = Menu::find();
        if( $asArray ===  TRUE){ $query->asArray(); }
        return $query->getTree($categoryId, $parentId);
    }

}
