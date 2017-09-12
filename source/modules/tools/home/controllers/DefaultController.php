<?php

namespace source\modules\tools\home\controllers;

class DefaultController extends \source\core\base\BaseController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
