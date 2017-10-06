<?php
/**
 * User: BrandonXu
 * Date: 2017/8/13
 * Time: 22:44
 */

namespace source\modules\menu\home\controllers;

use frontend\controllers\BaseRestController;

class ApiController extends BaseRestController
{

    public $defaultAction = 'home-tree';

    public function init() {
        parent::init();
        $this->actionNamespace = 'source\modules\menu\actions';
    }

    public function actions() {
        return [];
    }

    protected function verbs() {
        $verbs = parent::verbs();

        return $verbs;
    }

    public function actionHomeTree($parentId = 0){
        return $this->menu->getTree('main', (int)$parentId);
    }

}