<?php

namespace source\modules\menu\models;

use Yii;
use source\core\base\BaseActiveRecord;

/**
 * @property string $id
 * @property string $name
 * @property string $description
 */
class MenuCategory extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%menu_category}}';

    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'name'], 'required'],
            [['id', 'name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 512],
            [['id'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    public function beforeDelete() {
        Menu::deleteAll(['category_id' => $this->id]);

        return TRUE;
    }
}
