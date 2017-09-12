<?php

namespace source\modules\log\home\controllers;

class DefaultController extends \source\core\base\BaseController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
