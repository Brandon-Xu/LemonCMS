<?php

namespace source\modules\tools\admin\controllers;

use source\core\back\BackController;

class DbController extends BackController
{
    public function actionIndex() {
        return $this->render('index', []);
    }
}
