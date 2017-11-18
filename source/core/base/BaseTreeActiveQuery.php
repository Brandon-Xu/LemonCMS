<?php
/**
 * User: BrandonXu
 */

namespace source\core\base;

use yii\base\Model;
use yii\db\ActiveQuery;

/**
 * 这个文件我就不解释了 ！
 * Class MenuActiveQuery
 * @package source\modules\dict\models
 * @see \yii\db\ActiveRecord
 */
class BaseTreeActiveQuery extends ActiveQuery
{

    public function init() {
        $this->where([
            'status' => 1
        ]);
        parent::init();
    }

    /**
     * @param bool $andKeepWithSubItem
     * @return $this
     */
    public function withSubItem($andKeepWithSubItem = TRUE){
        $this->with([
            'subItem'=> function($query) use ($andKeepWithSubItem) {
                /** @var static $query */
                if($andKeepWithSubItem === TRUE){
                    $query->withSubItem(); }
                $query->select()->sort();
                return $query;
            }
        ]);
        return $this;
    }

    /**
     * @param int $sort
     * @return $this
     */
    public function sort($sort = SORT_ASC){
        $this->orderBy(['sort_num' => $sort]);
        return $this;
    }

    /**
     * @param null $categoryId
     * @return $this
     */
    public function category($categoryId = NULL){
        if($categoryId !== NULL){
            $this->andWhere(['category_id'=>$categoryId]);
        }
        return $this;
    }

    /**
     * @param null $parentId
     * @return $this
     */
    public function parent($parentId = NULL){
        if(is_int($parentId)){
            $this->andWhere(['parent_id' => $parentId]);
        }
        return $this;
    }

    /**
     * @param array $columns
     * @param null $option
     * @return $this
     */
    public function select($columns = [], $option = NULL) {
        $normalSelect = [
            'id','parent_id'
        ];
        $columns = array_merge($normalSelect, $columns);
        parent::select($columns, $option);
        return $this;
    }

    /**
     * @param null $categoryId
     * @param int $parentId
     * @return Model[]
     */
    public function getTree($categoryId = NULL, $parentId = 0){
        return $this->select()->withSubItem()->category($categoryId)->parent($parentId)->sort()->all();
    }

}