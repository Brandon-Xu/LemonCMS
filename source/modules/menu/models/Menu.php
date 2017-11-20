<?php

namespace source\modules\menu\models;

use Yii;
use source\core\base\BaseActiveRecord;
use source\libs\Constants;
use source\LuLu;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

/**
 * This is the model class for table "lulu_menu".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $category_id
 * @property string $name
 * @property string $icon
 * @property string $url
 * @property string $target
 * @property string $description
 * @property string $thumb
 * @property integer $status
 * @property integer $sort_num
 *
 * @property Menu[] $subItem
 * @property Menu[] $subMenu
 */
class Menu extends BaseActiveRecord
{
    const CachePrefix = 'menu_';

    public function init() {
        $this->target = Constants::SELF;
        $this->status = Constants::BLANK;

        parent::init();
    }

    public static function find(){
        return new MenuActiveQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['parent_id', 'category_id', 'name', 'url'], 'required'],
            [['parent_id', 'status', 'sort_num'], 'integer'],
            [['name', 'target', 'category_id'], 'string', 'max' => 64],
            [['url', 'description', 'thumb'], 'string', 'max' => 512],
            [['icon'], 'string', 'max' => 256],
        ];
    }

    public function attributeLabels() {
        return [
            'id'            => Yii::t('app', 'Id'),
            'parent_id'     => Yii::t('app', 'Parent'),
            'category_id'   => Yii::t('app', 'Category'),
            'name'          => Yii::t('app', 'Name'),
            'icon'          => Yii::t('app', 'Icon'),
            'url'           => Yii::t('app', 'Url'),
            'target'        => Yii::t('app', 'Target'),
            'description'   => Yii::t('app', 'Description'),
            'thumb'         => Yii::t('app', 'Thumb'),
            'status'        => Yii::t('app', 'Status'),
            'sort_num'      => Yii::t('app', 'Sort Num'),
        ];
    }

    public function getSubItem(){
        return $this->hasMany(static::className(), ['parent_id'=>'id']);
    }

    public function getSubMenu(){
        return $this->subItem;
    }

    protected $defaultIcon = '<i class="fa fa-circle-o"></i>';
    public function afterFind() {
        $re = parent::afterFind();
        if(empty($this->icon)){
            $this->icon = $this->defaultIcon;
        }
        return $re;
    }

}
