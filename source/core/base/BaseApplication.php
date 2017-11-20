<?php

namespace source\core\base;

use source\libs\Common;
use source\traits\Theme;
use yii\web\Application;

class BaseApplication extends Application
{

    use \source\traits\Common;
    use Theme;

    public $defaultRoute = 'site';

    public function init() {
        parent::init();
        Common::init();
    }

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
