<?php
/**
 * User: BrandonXu
 * Date: 2017/9/3
 * Time: 0:43
 */

namespace source\models;

use source\core\base\ActiveQuery;
use source\libs\Constants;

class ContentQuery extends ActiveQuery
{

    public function normalSelect($moreFields = []){
        $fields = [
            'id',
            'taxonomy_id',
            'created_at',
            'updated_at',
            'view_count',
            'status',
            'content_type',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'title',
            'sub_title',
            'summary',
            'thumb',
            'thumbs',
        ];
        if(is_array($moreFields) && !empty($moreFields)){
            $fields = array_merge($fields, $moreFields);
        }
        $this->select($fields);
        return $this;
    }

    public function published() {
        $this->where(['status' => Constants::Status_Publish]);
        return $this;
    }

}