<?php
/**
 * User: BrandonXu
 * Date: 2017/8/25
 * Time: 20:11
 */

namespace source\modules\taxonomy\home\controllers;

use frontend\controllers\BaseRestController;
use source\models\Content;

class ApiController extends BaseRestController
{

    public $modelClass = 'source\modules\taxonomy\models\Taxonomy';

    public function actions() {
        return [];
        //return parent::actions();
    }

    public function actionView($id, $sticky = FALSE){
        if($sticky == 'false') $sticky = FALSE;
        $contents = Content::find()->published()->normalSelect()->where(['taxonomy_id' => $id]);
        if($sticky !== FALSE){
            $contents->andWhere(['>', 'sticky', (int)$sticky]); }
        return [
            'taxonomy' => $this->findModel($id),
            'contents' => $contents->all()
        ];
    }

    protected function findModel($id){
        /** @var \source\modules\taxonomy\models\Taxonomy $model */
        $model = new $this->modelClass;
        return $model::findOne(['id'=>$id]);
    }

    public function actionGetTree() {

    }

}