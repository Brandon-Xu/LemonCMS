<?php

namespace source\models;

use Carbon\Carbon;
use source\core\base\BaseActiveRecord;
use source\core\behaviors\DefaultValueBehavior;
use source\libs\Common;
use source\libs\Constants;
use source\LuLu;
use source\modules\taxonomy\models\Taxonomy;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property integer $taxonomy_id
 *
 * @property integer $user_id
 * @property string $user_name
 * @property integer $last_user_id
 * @property string $last_user_name
 *
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property integer $focus_count
 * @property integer $favorite_count
 * @property integer $view_count
 * @property integer $comment_count
 * @property integer $agree_count
 * @property integer $against_count
 *
 * @property integer $recommend
 * @property integer $headline
 * @property integer $sticky
 * @property integer $flag
 *
 * @property integer $allow_comment
 * @property string $password
 * @property string $view
 * @property string $layout
 *
 * @property integer $sort_num
 * @property integer $visibility
 * @property integer $status
 *
 * @property string $content_type
 *
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 *
 * @property string $title
 * @property string $sub_title
 * @property string $url_alias
 * @property string $summary
 * @property string $thumb
 * @property string $thumb2
 * @property string $thumbs
 *
 * @property ContentBody $body
 * @property Taxonomy $taxonomy
 *
 */
class Content extends BaseActiveRecord
{

    /**
     * @var ContentBody $bodyClass 内容表对应的 model 名
     */
    private $_bodyClass;

    /**
     * 这个类我不想解释了！
     * @return ContentQuery
     */
    public static function find() {
        return new ContentQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getCreatedAt() {
        return $this->getTimeFormat($this->created_at);
    }

    /**
     * @return string
     */
    public function getUpdatedAt() {
        return $this->getTimeFormat($this->updated_at);
    }

    private function getTimeFormat($timestamp){
        $datetime_pretty_format = Config::get('datetime_pretty_format');
        $carbon = $this->getCarbon($timestamp);
        return ($datetime_pretty_format === '1') ? $carbon->diffForHumans() : $carbon->__toString();
    }

    /**
     * @param integer $timestamp
     * @return Carbon
     */
    public function getCarbon($timestamp){
        return Carbon::createFromTimestamp($timestamp);
    }

    /**
     * @return array
     */
    public function getStatusText() {
        return Constants::getStatusItemsForContent($this->status);
    }

    /**
     * @return string
     */
    public function getUserText() {
        return Html::a($this->user_name, ['/user']);
    }

    /**
     * @return string
     */
    public function getUrl() {
        return Url::to([
            '/'.$this->content_type.'/default/detail', 'id' => $this->id,
        ]);
    }

    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load($data, $formName = NULL) {
        $t = $this->thumb;
        $data = parent::load($data, $formName);
        if(empty($this->thumb)){
            $this->thumb = $t;
        }
        return $data;
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert) {
        $uploadedFile = Common::uploadFile('Content[thumb]');
        if ($uploadedFile['message'] === 'ok') {
            $this->thumb = $uploadedFile['full_name'];
        }
        $uploadedFile = Common::uploadFile('Content[thumb2]');
        if ($uploadedFile['message'] === 'ok') {
            $this->thumb2 = $uploadedFile['full_name'];
        }

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaxonomy() {
        return $this->hasOne(LuLu::getService('taxonomy')->getModel("Taxonomy"), ['id' => 'taxonomy_id']);
    }

    /**
     * @return null|ContentBody|string
     */
    public function getBodyClass() {
        if ($this->_bodyClass === NULL && !empty($this->content_type)) {
            $contentType = strtolower($this->content_type);
            $className = "source\\modules\\{$contentType}\\models\\Content".ucfirst($contentType);
            if (Common::classExist($className)) {
                $this->_bodyClass = $className;
            }
        }

        return $this->_bodyClass;
    }

    public function getBody() {
        if ($this->getBodyClass() !== NULL && is_subclass_of($this->getBodyClass(), ContentBody::className())) {
            $className = $this->getBodyClass();
            $one = $this->hasOne($className::className(), ['content_id' => 'id']);
            if ($one->primaryModel->isNewRecord){
                return new $className;
            }else {
                return $one;
            }
        }
        return $this->hasOne(ContentBody::className(), []);
    }

    /**
     * @param $class
     * @param array $condition
     * @param array $columns
     * @return Query
     */
    public static function getBodyByClass($class, $condition = [], $columns = []) {
        /** @var ActiveRecord $bodyModel */
        $bodyModel = new $class();
        if (empty($columns)) {
            $columns = $bodyModel->getTableSchema()->columns;
        }

        $selects = ['content.*'];

        foreach ((array)$columns as $column) {
            $columnName = $column;
            if (is_object($column)) {
                $columnName = $column->name;
            }
            $selects[] = "body.$columnName as body_$columnName";
        }

        $query = new Query();
        $query->select($selects)->from(['content' => Content::tableName()])
            ->innerJoin(['body' => $bodyModel::tableName()], '{{content}}.[[id]]={{body}}.[[content_id]]');

        if (!empty($condition)) {
            $query->andWhere($condition);
        }

        return $query;
    }

    /**
     * @return array
     */
    public function behaviors() {
        return [
            [
                'class' => DefaultValueBehavior::className(),
                'validates' => [
                    'focus_count',
                    'favorite_count',
                    'view_count',
                    'comment_count',
                    'agree_count',
                    'against_count',
                ],
                'value' => 0,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [[ 'taxonomy_id', 'user_id', 'last_user_id', 'created_at', 'updated_at', 'focus_count',
               'favorite_count', 'view_count', 'comment_count', 'agree_count', 'against_count', 'sticky',
               'recommend', 'headline', 'flag', 'allow_comment', 'sort_num', 'visibility', 'status',], 'integer',],
            [['content_type', 'title'], 'required'],
            [['user_name', 'last_user_name', 'password', 'view', 'layout', 'content_type'], 'string', 'max' => 64],
            [['seo_title', 'seo_keywords', 'seo_description', 'title', 'sub_title', 'url_alias', 'redirect_url', 'thumb', 'thumb2', ], 'string', 'max' => 256,],
            [['summary'], 'string', 'max' => 512],
            [['thumbs'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id'                => Yii::t('app', 'ID'),
            'taxonomy_id'       => Yii::t('app', 'Taxonomy'),
            'user_id'           => Yii::t('app', 'User Id'),
            'user_name'         => Yii::t('app', 'Username'),
            'userText'          => Yii::t('app', 'Name'),
            'last_user_id'      => Yii::t('app', 'Last User Id'),
            'last_user_name'    => Yii::t('app', 'Last User Name'),
            'created_at'        => Yii::t('app', 'Created At'),
            'updated_at'        => Yii::t('app', 'Updated At'),
            'focus_count'       => Yii::t('app', 'Focus Count'),
            'favorite_count'    => Yii::t('app', 'Favorite Count'),
            'view_count'        => Yii::t('app', 'PV'),
            'comment_count'     => Yii::t('app', 'Comments'),
            'agree_count'       => Yii::t('app', 'Agree Count'),
            'against_count'     => Yii::t('app', 'Against Count'),
            'recommend'         => Yii::t('app', 'Recommend'),
            'headline'          => Yii::t('app', 'Headline'),
            'sticky'            => Yii::t('app', 'Sticky'),
            'flag'              => Yii::t('app', 'Flag'),
            'allow_comment'     => Yii::t('app', 'Allow Comment'),
            'password'          => Yii::t('app', 'Password'),
            'view'              => Yii::t('app', 'View'),
            'layout'            => Yii::t('app', 'Layout'),
            'sort_num'          => Yii::t('app', 'Sort Num'),
            'visibility'        => Yii::t('app', 'Visibility'),
            'status'            => Yii::t('app', 'Status'),
            'statusText'        => Yii::t('app', 'Status'),
            'content_type'      => Yii::t('app', 'Content Type'),
            'seo_title'         => Yii::t('app', 'SEO Title'),
            'seo_keywords'      => Yii::t('app', 'SEO Keywords'),
            'seo_description'   => Yii::t('app', 'SEO Description'),
            'title'             => Yii::t('app', 'Title'),
            'sub_title'         => Yii::t('app', 'Sub Title'),
            'url_alias'         => Yii::t('app', 'Url Alias'),
            'redirect_url'      => Yii::t('app', 'Redirect Url'),
            'summary'           => Yii::t('app', 'Summary'),
            'thumb'             => Yii::t('app', 'Thumb'),
            'thumb2'            => Yii::t('app', 'Second Thumb'),
            'thumbs'            => Yii::t('app', 'Thumbs'),
        ];
    }

}
