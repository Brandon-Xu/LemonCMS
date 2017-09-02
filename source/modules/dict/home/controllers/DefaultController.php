<?php

namespace source\modules\dict\home\controllers;

class DefaultController extends \source\core\front\FrontController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
