<?php
/**
 * User: BrandonXu
 */

namespace source\core\rbac;

use source\core\modularity\AdminModule;

class RbacModule extends AdminModule
{

    public $defaultRoute = 'assignment';

    /**
     * @var string the namespace that controller classes are in
     */
    public $controllerNamespace = 'yii2mod\rbac\controllers';

    public function beforeAction($action) {
        $this->setLayoutPath('@vendor/yii2mod/yii2-rbac/views/layouts');
        $this->setViewPath('@vendor/yii2mod/yii2-rbac/views');
        return TRUE;
    }

}