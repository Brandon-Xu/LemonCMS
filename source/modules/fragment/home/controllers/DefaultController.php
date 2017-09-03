<?php

namespace source\modules\fragment\home\controllers;

use source\core\front\FrontController;

class DefaultController extends FrontController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
