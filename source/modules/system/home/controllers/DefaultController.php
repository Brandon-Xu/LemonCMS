<?php

namespace source\modules\system\home\controllers;

use source\LuLu;
use source\models\Content;
use source\modules\taxonomy\models\Taxonomy;


class DefaultController extends BaseController
{

    public function actionIndex() {
        $taxonomy = app()->request->get('taxonomy');
        $query = Content::find();
        $query->where(['content_type' => $this->content_type]);
        $query->andFilterWhere(['taxonomy_id' => $taxonomy]);

        if ($taxonomy === NULL) {
            $taxonomyModel = Taxonomy::findOne(['id' => $taxonomy]);
        } else {
            $taxonomyModel = ['id' => NULL, 'name' => '所有'];
        }

        $locals = LuLu::getPagedRows($query, ['orderBy' => 'created_at desc', 'pageSize' => 10]);
        $locals['taxonomyModel'] = $taxonomyModel;

        return $this->render('index', $locals);
    }

}
