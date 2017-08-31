<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/8/13
 * Time: 22:44
 */

namespace source\modules\post\home\controllers;

use frontend\controllers\BaseRestController;
use source\models\Content;
use source\modules\post\models\ContentPost;
use source\modules\taxonomy\models\Taxonomy;
use yii\web\Response;

class ApiController extends BaseRestController
{

    public $modelClass = 'source\modules\post\models\ContentPost';

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    protected function verbs() {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function actionIndex(){
        return [123];
    }

    public function actionView($id){
        return [1123,1455];
    }

    public function actionB() {
        //return app()->request->getBodyParams();
        return [
            'url' => app()->urlManager->createAbsoluteUrl(['app/']),
        ];
    }




}