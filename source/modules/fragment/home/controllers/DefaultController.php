<?php

namespace source\modules\fragment\home\controllers;

class DefaultController extends \source\core\front\FrontController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
