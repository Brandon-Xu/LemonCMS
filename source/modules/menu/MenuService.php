<?php

namespace source\modules\menu;

use source\core\modularity\ModuleService;
use source\core\widgets\ActiveField;
use source\core\widgets\ActiveForm;
use source\modules\menu\models\Menu;
use yii\base\Model;
use yii\helpers\Html;

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

    /**
     * 递归返回树状下拉菜单选项
     * @param ActiveForm $form
     * @param Model $model
     * @param string $attribute
     * @param Menu[] $menus
     * @return string
     */
    public function dropDownListTree($form, $model, $attribute, $menus){
        $items = [];
        /**
         * 递归函数
         * Recursively Function
         * @param Menu $menu
         * @param string $tab
         */
        $rec = function(Menu $menu, $tab = '') use (&$items, &$rec){
            $preStr = empty($tab) ? '' : "$tab|---";
            $items[$menu->id] = $preStr.$menu->name;
            $tab .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            if (!empty($menu->subMenu)){
                foreach ($menu->subMenu as $subMenu){ $rec($subMenu, $tab); }
            }
        };
        foreach ($menus as $key => $menu){ $rec($menu); }
        return $form->field($model, $attribute)->dropDownList($items, ['encode'=>FALSE]);
    }

}
