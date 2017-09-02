<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/8/25
 * Time: 20:11
 */

namespace source\modules\taxonomy\home\controllers;

use frontend\controllers\BaseRestController;

class ApiController extends BaseRestController
{

    public $modelClass = 'source\modules\taxonomy\models\Taxonomy';

    public function actions() {
        //return [];
        return parent::actions();
    }

    public function actionGetTree() {

    }

}