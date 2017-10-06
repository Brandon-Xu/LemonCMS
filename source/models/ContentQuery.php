<?php
/**
 * User: BrandonXu
 * Date: 2017/9/3
 * Time: 0:43
 */

namespace source\models;

use source\libs\Constants;
use yii\base\Application;
use yii\db\ActiveQuery;

/**
 * Class ContentQuery
 * @package source\models
 */
class ContentQuery extends ActiveQuery
{

    /**
     * @return $this
     */
    public function published() {
        $this->andwhere(['status' => Constants::Status_Publish])->orderBy(['sort_num' => SORT_DESC]);

        return $this;
    }

    public function withAll() {
        $this->with(['body', 'taxonomy']);

        return $this;
    }

    /**
     * 给个默认的返回字段列表
     * @param array $moreFields
     * @return $this
     */
    public function normalSelect($moreFields = []) {
        $fields = [
            'id',
            'taxonomy_id',
            'created_at',
            'updated_at',
            'view_count',
            'status',
            'content_type',
            'headline',
            'sticky',
            'seo_title',
            'seo_keywords',
            'seo_description',
            'title',
            'sub_title',
            'summary',
            'thumb',
            'thumb2',
            'thumbs',
        ];
        if (is_array($moreFields) && !empty($moreFields)) {
            $fields = array_merge($fields, $moreFields);
        }
        $this->select($fields);

        return $this;
    }


    public function type($contentType = NULL) {
        if ($contentType === NULL) {
            $module = app()->controller->module;
            if (!($module instanceof Application)) {
                $contentType = $module->id;
            }
        }
        if (is_string($contentType)) {
            $this->andWhere(['content_type' => $contentType]);
        }

        return $this;
    }

    /**
     * @return ContentQuery
     */
    public function notPic() {
        return $this->isPic(FALSE);
    }

    /**
     * @param bool $v
     * @return $this
     */
    public function isPic($v = TRUE) {
        if ($v) {
            $this->andWhere(['!=', 'thumb', '',]);
        }

        return $this;
    }

}