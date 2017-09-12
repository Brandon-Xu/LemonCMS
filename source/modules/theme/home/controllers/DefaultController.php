<?php

namespace source\modules\theme\home\controllers;

class DefaultController extends \source\core\base\BaseController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
