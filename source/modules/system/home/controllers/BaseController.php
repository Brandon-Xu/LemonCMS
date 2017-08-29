<?php
namespace source\modules\system\home\controllers;

use frontend\controllers\BaseContentController;

class BaseController extends BaseContentController
{
	
    public function init()
    {
        parent::init();
    	$this->content_type = 'post';
    }
   
   
}
