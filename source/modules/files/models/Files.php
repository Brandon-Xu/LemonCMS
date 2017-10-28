<?php

namespace source\modules\files\models;

use Yii;
use source\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%files}}".
 *
 * @property string $id
 * @property string $driver
 * @property string $filename
 * @property string $type
 * @property string $size
 * @property string $basename
 * @property string $extension
 * @property integer $uploaderId
 * @property string $basePath
 * @property string $absUrl
 * @property string $created_at
 * @property string $created_date
 * @property string $summary
 *
 * @property User $uploader
 */
class Files extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver', 'filename', 'type', 'size', 'basename', 'extension', 'uploaderId', 'basePath', 'absUrl', 'created_at', 'created_date'], 'required'],
            [['size', 'uploaderId', 'created_at', 'created_date'], 'integer'],
            [['id', 'type'], 'string', 'max' => 50],
            [['driver', 'filename', 'basename'], 'string', 'max' => 128],
            [['extension'], 'string', 'max' => 20],
            [['basePath', 'absUrl', 'summary'], 'string', 'max' => 256],
            [['uploaderId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uploaderId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'HASH ID'),
            'driver' => Yii::t('app', 'File Saver'),
            'filename' => Yii::t('app', 'File Name'),
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'basename' => Yii::t('app', 'Base Name'),
            'extension' => Yii::t('app', 'Extension'),
            'uploaderId' => Yii::t('app', 'Uploader'),
            'basePath' => Yii::t('app', 'Base Path'),
            'absUrl' => Yii::t('app', 'Link'),
            'created_at' => Yii::t('app', 'Create At'),
            'created_date' => Yii::t('app', 'Created Date'),
            'summary' => Yii::t('app', 'Summary'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUploader()
    {
        return $this->hasOne(User::className(), ['id' => 'uploaderId']);
    }
}
