<?php

namespace source\modules\page\home\controllers;

use frontend\controllers\BaseContentController;
use source\modules\page\models\ContentPage;

class DefaultController extends BaseContentController
{

    public function init() {
        parent::init();
        $this->content_type = 'page';
        $this->bodyClass = ContentPage::className();
    }

}
