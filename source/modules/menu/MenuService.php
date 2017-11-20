<?php

namespace source\modules\menu;

use source\core\modularity\ModuleService;
use source\core\widgets\ActiveField;
use source\core\widgets\ActiveForm;
use source\modules\menu\models\Menu;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class MenuService extends ModuleService
{

    const SELF = '_self';
    const BLANK = '_blank';

    public function getServiceId() {
        return 'menuService';
    }

    /**
     * @param null $categoryId
     * @param int $parentId
     * @param bool $asArray
     * @return Menu|Model[]
     */
    public function getTree($categoryId = NULL, $parentId = 0, $asArray = TRUE){
        $query = Menu::find();
        if( $asArray ===  TRUE){ $query->asArray(); }
        return $query->getTree($categoryId, $parentId);
    }

    public function getTargets() {
        $items = [
            self::SELF => '当前窗口',
            self::BLANK => '新窗口',
        ];
        return $items;
    }

    public function getTarget($key){
        return ArrayHelper::getValue($this->getTargets(), $key);
    }
}
