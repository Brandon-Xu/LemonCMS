<?php
/**
 * User: BrandonXu
 * Date: 2017/8/13
 * Time: 22:44
 */

namespace source\modules\post\home\controllers;

use frontend\controllers\BaseRestController;
use source\models\Content;
use source\modules\post\models\ContentPost;

class ApiController extends BaseRestController
{

    public function init() {
        parent::init();
        $this->bodyClass = ContentPost::className();
        $this->content_type = 'post';
        $this->pageSize_index = 10;
        $this->actionNamespace = 'source\modules\post\actions';
    }

    public function actions() {
        $actions = parent::actions();

        return $actions;
    }

    protected function verbs() {
        $verbs = parent::verbs();

        return $verbs;
    }

}