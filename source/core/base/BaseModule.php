<?php

namespace source\core\base;

use source\traits\Common;
use source\traits\Theme;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class BaseModule extends Module
{

    use Common;
    use Theme;

    const Status_Installed = 'Installed';
    const Status_Uninstalled = 'Uninstalled';
    const Status_Activity = 'Activity';
    const Status_Inactivity = 'Inactivity';

    /**
     * 实现 Theme Traits 里规定必须实现的 beforeAction 事件方法
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action) {
        $this->setTheme();
        return parent::beforeAction($action);
    }

}
