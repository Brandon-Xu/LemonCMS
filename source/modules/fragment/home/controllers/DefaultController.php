<?php

namespace source\modules\fragment\home\controllers;

use source\core\base\BaseController;

class DefaultController extends BaseController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
