<?php

namespace source\modules\post\home;

class HomeModule extends \source\core\modularity\HomeModule
{
    public $controllerNamespace = 'source\modules\post\home\controllers';

    public function init() {
        app()->urlManager->addRules([
            [
                'class' => 'yii\rest\UrlRule', 'controller' => ['post/api' => 'post/api'],
            ],
        ]);
        parent::init();
    }
}
