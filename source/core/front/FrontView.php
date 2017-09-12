<?php

namespace source\core\front;

use source\core\base\BaseView;
use source\core\front\widgets\ActiveForm;
use source\libs\DataSource;
use source\LuLu;

class FrontView extends BaseView
{

    public function getMenus($category = 'main', $parentId = 0) {
        return app()->menu->getChildren($category, $parentId, 1);
    }

    public function renderMenu($category = 'main', $parentId = 0) {
        echo app()->menu->getMenuHtml($category, 0);
    }

    public function getFragmentData($code, $options = []) {
        return DataSource::getFragmentData($code, $options);
    }


    public function beginForm($options = []) {
        $class = ActiveForm::className();

        return $this->beginWidget($class, $options);
    }

    public function endForm() {
        $class = ActiveForm::className();

        return $this->endWidget($class);
    }

    public function toolbars($bars = []) {
        LuLu::setViewParam(['toolbars' => $bars]);
    }

}
