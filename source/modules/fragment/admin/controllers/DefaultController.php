<?php

namespace source\modules\fragment\admin\controllers;

use source\core\back\BackController;

class DefaultController extends BackController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
