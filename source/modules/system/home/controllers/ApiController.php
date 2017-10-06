<?php
/**
 * User: BrandonXu
 * Date: 2017/8/13
 * Time: 22:44
 */

namespace source\modules\system\home\controllers;

use frontend\controllers\BaseRestController;
use source\modules\system\models\config\BasicConfig;

class ApiController extends BaseRestController
{

    public function init() {
        parent::init();
        $this->actionNamespace = 'source\modules\system\actions';
    }

    public function actions() {
        return [];
    }

    protected function verbs() {
        $verbs = parent::verbs();

        return $verbs;
    }

    public function actionIndex(){
        return new BasicConfig();
    }

}