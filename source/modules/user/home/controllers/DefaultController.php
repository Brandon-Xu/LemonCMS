<?php

namespace source\modules\user\home\controllers;

use source\models\Content;

use source\LuLu;
use source\modules\taxonomy\models\Taxonomy;


class DefaultController extends BaseController
{
   
    public function actionIndex()
    {
    	$taxonomy=LuLu::getGetValue('taxonomy');
    	$query = Content::find();
    	$query->where(['content_type'=>$this->content_type]);
    	$query->andFilterWhere(['taxonomy_id'=>$taxonomy]);

        $taxonomyModel=['id'=>null,'name'=>'所有'];
        if($taxonomy===null) {
    		$taxonomyModel=Taxonomy::findOne(['id'=>$taxonomy]);
    	}
    	
    	$locals = LuLu::getPagedRows($query,['orderBy'=>'created_at desc','pageSize'=>10]);
    	$locals['taxonomyModel']=$taxonomyModel;
    	
    	return $this->render('index', $locals);
    }
    
    
}