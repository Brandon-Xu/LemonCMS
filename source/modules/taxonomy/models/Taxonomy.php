<?php

namespace source\modules\taxonomy\models;

use source\core\base\BaseActiveRecord;
use source\LuLu;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%taxonomy}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $category_id
 * @property string $name
 * @property string $url_alias
 * @property string $redirect_url
 * @property string $thumb
 * @property string $description
 * @property integer $page_size
 * @property string $list_view
 * @property string $list_layout
 * @property string $detail_view
 * @property string $detail_layout
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property integer $contents
 * @property integer $sort_num
 *
 * @property Taxonomy[] subItem
 * @property Taxonomy[] subTaxonomy
 */
class Taxonomy extends BaseActiveRecord
{
    const CachePrefix = 'taxonomy_';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%taxonomy}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['category_id', 'parent_id', 'name', 'sort_num'], 'required'],
            [['parent_id', 'page_size', 'contents', 'sort_num'], 'integer'],
            [['category_id', 'name', 'url_alias', 'list_view', 'list_layout', 'detail_view', 'detail_layout'], 'string', 'max' => 64 ],
            [['redirect_url', 'thumb'], 'string', 'max' => 128],
            [['description', 'seo_title', 'seo_keywords', 'seo_description'], 'string', 'max' => 256],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => '编号',
            'parent_id' => '父结点',
            'category_id' => '分类',
            'name' => '名称',
            'url_alias' => '别名',
            'redirect_url' => '跳转链接',
            'thumb' => '缩略图',
            'description' => '描述',
            'page_size' => '每页大小',
            'list_view' => '列表面view',
            'list_layout' => '列表面layout',
            'detail_view' => '内容页view',
            'detail_layout' => '内容页layout',
            'seo_title' => '标题',
            'seo_keywords' => '关键字',
            'seo_description' => '描述',
            'contents' => '内容数量',
            'sort_num' => '排序',
        ];
    }

    public static function find() {
        return new TaxonomyActiveQuery(get_called_class());
    }

    public function getSubItem(){
        return $this->hasMany(static::className(), ['parent_id'=>'id']);
    }

    public function getSubTaxonomy(){
        return $this->subItem;
    }
}
