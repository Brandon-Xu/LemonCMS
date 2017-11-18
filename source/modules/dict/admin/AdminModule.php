<?php

namespace source\modules\dict\admin;

class AdminModule extends \source\core\modularity\AdminModule
{

    public $controllerNamespace = 'source\modules\dict\admin\controllers';

    public $defaultRoute = 'dict-category';

    public function init() {
        app()->urlManager->addRules([
            '<module:\w+>/<subModule:(dict)>/categories' => '<module>/<subModule>/dict-category/index',

            '<module:\w+>/<subModule:(dict)>/<category>' => '<module>/<subModule>/dict/index',
            '<module:\w+>/<subModule:(dict)>/<category>/<action:\w+>' => '<module>/<subModule>/dict/<action>',

            '<module:\w+>/<subModule:(dict)>/category/<id>/<action:\w+>' => '<module>/<subModule>/dict-category/<action>',
            '<module:\w+>/<subModule:(dict)>/category/<action:\w+>' => '<module>/<subModule>/dict-category/<action>',
        ], FALSE);
        parent::init();
    }

}
