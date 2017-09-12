<?php

namespace source\modules\page\admin\controllers;

use source\modules\admin\controllers\BaseContentController;
use source\modules\page\models\ContentPage;

class PageController extends BaseContentController
{

    public function init() {
        parent::init();
        $this->content_type = 'page';
        $this->bodyClass = ContentPage::className();
    }

}
