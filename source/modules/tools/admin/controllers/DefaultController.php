<?php

namespace source\modules\tools\admin\controllers;

class DefaultController extends \source\core\base\BackController
{
    public function actionIndex() {
        return $this->render('index');
    }
}
