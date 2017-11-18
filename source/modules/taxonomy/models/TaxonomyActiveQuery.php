<?php
/**
 * User: BrandonXu
 * Date: 2017/9/13
 * Time: 22:53
 */
namespace source\modules\taxonomy\models;

use source\core\base\BaseTreeActiveQuery;

/**
 * 这个文件我就不解释了 ！
 * Class MenuActiveQuery
 * @package source\modules\menu\models
 * @see \yii\db\ActiveRecord
 */
class TaxonomyActiveQuery extends BaseTreeActiveQuery
{

    /**
     * @param array $columns
     * @param null $option
     * @return $this
     */
    public function select($columns = [], $option = NULL) {
        $normalSelect = [
            'id','parent_id','category_id' , 'name', 'url_alias', 'redirect_url', 'thumb', 'description'
        ];
        $columns = array_merge($normalSelect, $columns);
        parent::select($columns, $option);
        return $this;
    }

}