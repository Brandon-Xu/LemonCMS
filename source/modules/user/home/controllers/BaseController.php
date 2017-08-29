<?php
namespace source\modules\user\home\controllers;

use frontend\controllers\BaseContentController;

class BaseController extends BaseContentController
{
    public function init()
    {
    	$this->content_type = 'post';
    	parent::init();
    }
}
