<?php

namespace source\modules\post\admin\controllers;

use backend\controllers\BaseContentController;
use source\modules\post\models\ContentPost;

class PostController extends BaseContentController
{

    public function init() {
        parent::init();
        $this->content_type = 'post';
        $this->bodyClass = ContentPost::className();
    }
}
