<?php

namespace source\modules\dict\models;

use source\core\base\BaseActiveRecord;

/**
 * This is the model class for table "{{%dict}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $category_id
 * @property string $name
 * @property string $value
 * @property string $description
 * @property string $thumb
 * @property integer $status
 * @property integer $sort_num
 *
 * @property Dict[] $subItem
 * @property Dict[] $subDict
 * @property DictCategory $category
 */
class Dict extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%dict}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_id', 'category_id', 'name', 'value'], 'required'],
            [['parent_id', 'status', 'sort_num'], 'integer'], [['value'], 'string'],
            [['category_id', 'name'], 'string', 'max' => 64], [['description', 'thumb'], 'string', 'max' => 512],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => '编号',
            'parent_id' => '父级',
            'category_id' => '分类',
            'name' => '名称',
            'value' => '值',
            'description' => '描述',
            'thumb' => '缩略图',
            'status' => '状态',
            'statusText' => '状态',
            'sort_num' => '排序',
        ];
    }

    public static function find() {
        return new DictActiveQuery(get_called_class());
    }

    public function getSubItem(){
        return $this->hasMany(static::className(), ['parent_id'=>'id']);
    }

    public function getSubDict(){
        return $this->subItem;
    }

    public function getCategory(){
        return $this->hasOne(DictCategory::className(), ['id'=>'category_id']);
    }
}
