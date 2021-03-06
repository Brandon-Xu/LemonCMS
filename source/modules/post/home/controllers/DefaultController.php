<?php

namespace source\modules\post\home\controllers;

use frontend\controllers\BaseContentController;
use source\modules\post\models\ContentPost;

class DefaultController extends BaseContentController
{
    public function init() {
        parent::init();
        $this->content_type = 'post';
        $this->bodyClass = ContentPost::className();
        $this->pageSize_index = 10;
    }
}
