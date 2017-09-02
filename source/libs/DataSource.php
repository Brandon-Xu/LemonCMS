<?php

namespace source\libs;

use source\LuLu;
use source\models\Content;
use source\modules\fragment\models\Fragment;
use yii\base\Application;

class DataSource
{

    /**
     *
     * @param string $where
     * @param string $orderBy
     * @param number $pageSize
     * @param array $options
     * --recommend
     * --headline
     * --sticky
     * --flag
     * --is_pic
     * --content_type
     * --page
     * --taxonomy:array or number
     *
     * @return array:['rows','pager']
     */
    public static function getPagedContents($where = NULL, $orderBy = NULL, $pageSize = 10, $options = []) {
        $query = self::buildContentQuery($where, $options);
        $query->joinWith('taxonomy', TRUE, 'LEFT JOIN');

        $page = isset($options[ 'page' ]) ? $options[ 'page' ] : NULL;
        $orderBy = empty($orderBy) ? 'created_at desc' : $orderBy;

        $locals = LuLu::getPagedRows($query, [
            'page' => $page, 'pageSize' => $pageSize, 'orderBy' => $orderBy,
        ]);

        return $locals;
    }


    /**
     *
     * @param string $where
     * @param string $orderBy
     * @param number $limit
     * @param array $options
     * --recommend
     * --headline
     * --sticky
     * --flag
     * --is_pic
     * --content_type
     * --page(offset)
     * --taxonomy: array or number
     *
     * @return array
     */
    public static function getContents($where = NULL, $orderBy = NULL, $limit = 10, $options = []) {
        $query = self::buildContentQuery($where, $options);

        $orderBy = empty($orderBy) ? 'created_at desc' : $orderBy;
        $query->orderBy($orderBy);

        if (isset($options[ 'page' ])) {
            $query->offset(intval($options[ 'page' ]));
        }

        if ($limit > 0) {
            $query->limit($limit);
        }

        return $query->all();
    }


    private static function buildContentQuery($where = NULL, $options = []) {
        $query = Content::find()->published()->andWhere($where);
        if (isset($options[ 'taxonomy' ])) {
            $ids = [];
            if (is_array($options[ 'taxonomy' ])) {
                foreach ($options[ 'taxonomy' ] as $t) {
                    if (intval($t) > 0) {
                        $ids[] = intval($t);
                    }
                }
            } else {
                if (intval($options[ 'taxonomy' ]) > 0) {
                    $ids = intval($options[ 'taxonomy' ]);
                }
            }
            if (!empty($ids)) {
                $query->andWhere(['taxonomy_id' => $ids]);
            }
        }
        foreach (['recommend', 'headline', 'sticky'] as $att) {
            if (isset($options[ $att ]) && is_integer($options[ $att ])) {
                $query->andWhere([$att => $options[ $att ]]);
            }
        }

        if (isset($options[ 'flag' ])) {
            $flagValue = Common::getFlagValue($options[ 'flag' ]);
            if ($flagValue > 0) {
                $query->andWhere('flag&'.$flagValue.'>0');
            }
        }

        if (isset($options[ 'is_pic' ])) {
            $query->andWhere([
                '!=', 'thumb', ''
            ]);
        }

        if (isset($options[ 'content_type' ])) {
            if (is_string($options[ 'content_type' ])) {
                $type = $options[ 'content_type' ];
            } else {
                $module = app()->controller->module;
                if (!($module instanceof Application)) {
                    $type = $module->id;
                }
            }
            if (!empty($type)) {
                $query->andWhere(['content_type' => $options[ 'content_type' ]]);
            }
        }

        return $query;
    }

    public static function getFragmentData($code, $options = [], $fromCache = TRUE) {
        return Fragment::getData($code, $options, $fromCache);
    }

}