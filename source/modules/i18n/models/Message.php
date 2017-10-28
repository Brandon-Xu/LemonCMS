<?php

namespace source\modules\i18n\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * @property SourceMessage $source
 */
class Message extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'language'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => SourceMessage::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => Yii::t('app', 'ID'),
            'language'      => Yii::t('app', 'Language'),
            'translation'   => Yii::t('app', 'Translation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(SourceMessage::className(), ['id' => 'id']);
    }

    public function registerTranslations() {

    }

    public static function t($message, $category = NULL, $params = [], $language = NULL) {
        $moduleUniqueId = app()->controller->module->uniqueId;
        $moduleUniqueId = empty($moduleUniqueId) ? 'home' : $moduleUniqueId;
        $ts = "{$moduleUniqueId}/*";
        if ($category !==  NULL){
            $ts = "{$category}/*";
            $moduleUniqueId = $category;
            $category = '';
        }
        if(!isset(app()->i18n->translations[$ts])){
            app()->i18n->translations[$ts] = app()->i18n->translations['app*'];
        }
        $category = $moduleUniqueId.'/*';
        return Yii::t($category, $message, $params, $language);
    }
}
