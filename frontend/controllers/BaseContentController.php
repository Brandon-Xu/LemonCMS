<?php

namespace frontend\controllers;

use source\core\base\BaseController;
use source\LuLu;
use source\models\Content;

class BaseContentController extends BaseController
{
    //首页页面大小
    public $pageSize_index = 10;

    //内容类型
    public $content_type;

    //内容body的class
    public $bodyClass;

    /**
     * 首页
     * @return string
     */
    public function actionIndex() {
        $query = Content::find()->published()->andWhere(['content_type' => $this->content_type]);

        $locals = LuLu::getPagedRows($query, [
            'orderBy' => 'created_at desc', 'pageSize' => $this->pageSize_index,
        ]);

        return $this->render('index_default', $locals);
    }

    /**
     * 列表页
     * @param integer $taxonomy
     * @return string
     */
    public function actionList($taxonomy = -1) {
        $query = Content::find()->published()->andWhere(['content_type' => $this->content_type]);
        if (intval($taxonomy) > 0) {
            $query->andFilterWhere(['taxonomy_id' => intval($taxonomy)]);
        }

        $taxonomyModel = app()->taxonomy->getTaxonomyById($taxonomy);
        LuLu::setViewParam(['taxonomyModel' => $taxonomyModel]);

        $vars = $this->getListVars($taxonomyModel);

        $locals = LuLu::getPagedRows($query, [
            'orderBy' => 'created_at desc', 'pageSize' => $vars['pageSize'],
        ]);
        $locals['taxonomyModel'] = $taxonomyModel;

        $this->layout = $vars['layout'];

        return $this->render($vars['view'], $locals);
    }


    /**
     * 内容页
     * @param $id
     * @return string
     */
    public function actionDetail($id) {
        Content::updateAllCounters(['view_count' => 1], ['id' => $id]);

        $locals = $this->getDetail($id);

        $taxonomyModel = app()->taxonomy->getTaxonomyById($locals['model']['taxonomy_id']);
        LuLu::setViewParam(['taxonomyModel' => $taxonomyModel]);

        $locals['taxonomyModel'] = $taxonomyModel;

        $vars = $this->getDetailVars($locals['taxonomyModel'], $locals['model']);

        $this->layout = $vars['layout'];

        return $this->render($vars['view'], $locals);
    }

    public function getDetail($id) {
        $model = Content::find()->with(['body'])->where(['id'=>$id])->one();
        $array = $model->toArray();
        if($model->body){
            $array['created_at'] = $model->createdAt;
            $array['updated_at'] = $model->updatedAt;
            $array['body_id'] = $model->body->id;
            $array['body_content_id'] = $model->body->content_id;
            $array['body_body'] = $model->body->body;
        }

        return [
            'model' => $array,
        ];
    }

    /**
     *
     * @param array $taxonomyModel
     * @return array ['view','layout','pageSize]
     */
    public function getListVars($taxonomyModel) {
        $vars = [];

        $vars['view'] = empty($taxonomyModel['list_view']) ? 'list_default' : $taxonomyModel['list_view'];
        $vars['layout'] = empty($taxonomyModel['list_layout']) ? NULL : $taxonomyModel['list_layout'];
        $vars['pageSize'] = empty($taxonomyModel['page_size']) ? 10 : $taxonomyModel['page_size'];

        return $vars;
    }

    /**
     *
     * @param array $taxonomyModel
     * @param array $detailModel
     * @return array ['view','layout']
     */
    public function getDetailVars($taxonomyModel, $detailModel) {
        $vars = [];

        if (!empty($detailModel['view'])) {
            $vars['view'] = $detailModel['view'];
        } else {
            $vars['view'] = empty($taxonomyModel['detail_view']) ? 'detail_default' : $taxonomyModel['detail_view'];
        }

        if (!empty($detailModel['layout'])) {
            $vars['layout'] = $detailModel['layout'];
        } else {
            $vars['layout'] = empty($taxonomyModel['detail_layout']) ? NULL : $taxonomyModel['detail_layout'];
        }

        return $vars;
    }
}
