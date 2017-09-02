<?php

namespace source\modules\post\home;

use frontend\controllers\ContentController;


class BaseController extends ContentController
{

    public function init() {
        $this->content_type = 'post';
        parent::init();
    }


}
