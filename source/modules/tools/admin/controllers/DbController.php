<?php

namespace source\modules\tools\admin\controllers;

class DbController extends \source\core\back\BackController
{
    public function actionIndex() {
        return $this->render('index', []);
    }
}
