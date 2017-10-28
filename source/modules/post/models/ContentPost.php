<?php

namespace source\modules\post\models;

use source\models\Content;
use source\models\ContentBody;
use Yii;

/**
 * This is the model class for table "{{%content_post}}".
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $body
 * @property Content $head
 */
class ContentPost extends ContentBody
{

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%content_post}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['content_id', 'body'], 'required'],
            [['content_id'], 'integer'],
            [['body'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'content_id' => Yii::t('app', 'Content ID'),
            'body' => Yii::t('app', 'Content'),
        ];
    }

}
