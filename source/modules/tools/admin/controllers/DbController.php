<?php

namespace source\modules\tools\admin\controllers;

use source\core\base\BackController;

class DbController extends BackController
{
    public function actionIndex() {
        return $this->render('index', []);
    }
}
