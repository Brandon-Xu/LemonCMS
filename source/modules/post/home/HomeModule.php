<?php

namespace source\modules\post\home;

use source\core\modularity\FrontModule;

class HomeModule extends FrontModule
{
    public $controllerNamespace = 'source\modules\post\home\controllers';

    public function init() {
        app()->urlManager->addRules([
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => ['post/api' => 'post/api'],
            ],
        ]);
        parent::init();
    }
}
