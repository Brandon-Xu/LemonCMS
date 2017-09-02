<?php

namespace source\core\front;

use source\core\base\BaseView;
use source\core\base\Theme;
use source\core\front\widgets\ActiveForm;
use source\libs\DataSource;
use source\libs\Resource;

class FrontView extends BaseView
{

    public function init() {
        parent::init();
    }

    public function setTheme() {
        $currentTheme = Resource::getHomeTheme();

        $moduleId = app()->controller->module->id;

        $config = [
            'pathMap' => [
                '@app/views' => [
                    '@statics/themes/'.$currentTheme.'/views', '@statics/themes/basic/views',
                ], '@source/modules/'.$moduleId.'/home/views' => [
                    '@statics/themes/'.$currentTheme.'/modules/'.$moduleId, '@statics/themes/basic/modules/'.$moduleId,
                ],
            ], 'basePath' => '@statics/themes/basic', 'baseUrl' => '@statics/themes/basic',
        ];

        $this->theme = new Theme($config);
    }

    public function getMenus($category = 'main', $parentId = 0) {
        return $this->menuService->getChildren($category, $parentId, 1);
    }

    public function renderMenu($category = 'main', $parentId = 0) {
        echo $this->menuService->getMenuHtml($category, 0);
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


}
