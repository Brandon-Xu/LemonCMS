<?php

namespace source\modules\theme\admin\controllers;

class DefaultController extends \source\core\back\BackController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
