<?php
/**
 * User: BrandonXu
 * Date: 2017/9/13
 * Time: 22:53
 */

namespace source\modules\menu\models;

use yii\db\ActiveQuery;

/**
 * 这个文件我就不解释了 ！
 * Class MenuActiveQuery
 * @package source\modules\menu\models
 */
class MenuActiveQuery extends ActiveQuery
{

    public function init() {
        $this->where([
            'status' => 1
        ]);
        parent::init();
    }

    /**
     * @param bool $andKeepWithSubMenu
     * @return $this
     */
    public function withSubMenu($andKeepWithSubMenu = TRUE){
        $this->with([
            'subMenu'=> function($query) use ($andKeepWithSubMenu) {
                /** @var static $query */
                if($andKeepWithSubMenu === TRUE){
                    $query->withSubMenu(); }
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
            'id','parent_id', 'name', 'url', 'target', 'description', 'thumb'
        ];
        $columns = array_merge($normalSelect, $columns);
        parent::select($columns, $option);
        return $this;
    }

    /**
     * @param null $categoryId
     * @param int $parentId
     * @return Menu[]
     */
    public function getTree($categoryId = NULL, $parentId = 0){
        return $this->select()->withSubMenu()->category($categoryId)->parent($parentId)->sort()->all();
    }
}