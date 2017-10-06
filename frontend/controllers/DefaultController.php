<?php
/**
 * User: BrandonXu
 * Date: 2017/9/13
 * Time: 21:34
 */

namespace frontend\controllers;

use source\modules\menu\models\Menu;
use source\traits\Common;
use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout = FALSE;

    public function actionIndex(){
        return $this->render('emptyHtml');
    }
}