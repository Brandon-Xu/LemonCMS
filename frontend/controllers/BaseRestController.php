<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/8/13
 * Time: 22:44
 */

namespace frontend\controllers;

use source\core\data\ActiveDataProvider;
use source\LuLu;
use Yii;
use source\models\Content;
use yii\base\InvalidCallException;
use yii\db\ActiveQuery;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Class BaseRestController
 * @package frontend\controllers
 */
class BaseRestController extends ActiveController
{

    /**
     * @var \source\models\Content $modelClass
     */
    public $modelClass = 'source\models\Content';

    /**
     * @var int $pageSize_index 内容列表长度
     */
    public $pageSize_index = 10;

    /**
     * @var string $content_type 内容类型
     */
    public $content_type;

    /**
     * @var string $bodyClass
     */
    public $bodyClass;

    /**
     * @var string $actionNamespace 自定义 restful api 的 action 文件所在命名空间
     */
    public $actionNamespace = 'yii\rest';
    private $defaultActionNamespace = 'source\core\rest';

    public function init() {
        parent::init();
        header('Access-Control-Allow-Origin:*');
        app()->response->on('beforeSend', function ($e) {
            $response = $e->sender;
            if ($response->data !== NULL) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'data' => ($response->isSuccessful) ? $response->data : $response->data,
                    'code' => $response->statusCode,
                ];
                $response->statusCode = 200;
            }
        });
    }

    public function actions() {
        $actions = [
            'index' => [
                'class' => 'IndexAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [ $this, 'checkAccess' ],
                'prepareDataProvider' => [ $this, 'listDataProvider' ] // 当前 Controller 下的 listDataProvider 方法
            ],
            'view' => [
                'class' => 'ViewAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [ $this, 'checkAccess' ],
                'prepareDataProvider' => [ $this, 'one' ] // 当前 Controller 下的 one 方法
            ],
            'create' => [
                'class' => 'CreateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [ $this, 'checkAccess' ],
                'scenario' => $this->createScenario,
            ],
            'update' => [
                'class' => 'UpdateAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [ $this, 'checkAccess' ],
                'scenario' => $this->updateScenario,
            ],
            'delete' => [
                'class' => 'DeleteAction',
                'modelClass' => $this->modelClass,
                'checkAccess' => [ $this, 'checkAccess' ],
            ],
            'options' => [
                'class' => 'OptionsAction',
            ],
        ];

        foreach ($actions as $k => $action) {
            $class = $action[ 'class' ];
            $fullClassName = "{$this->actionNamespace}\\{$class}";
            if (!class_exists($fullClassName)) {
                $fullClassName = "{$this->defaultActionNamespace}\\{$class}";
            }
            $actions[ $k ][ 'class' ] = $fullClassName;
        }

        return $actions;
    }

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors[ 'contentNegotiator' ][ 'formats' ] = ['application/json' => Response::FORMAT_JSON];

        return $behaviors;
    }

    protected function verbs() {
        return [
            'index' => [ 'GET', 'HEAD' ],
            'view' => [ 'GET', 'HEAD' ],
            'create' => ['POST'],
            'update' => [ 'PUT', 'PATCH' ],
            'delete' => ['DELETE'],
        ];
    }

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * 内容列表的数据来源
     * @return object
     */
    public function listDataProvider() {
        $query = Content::find()->published()->normalSelect()->andWhere(['content_type' => $this->content_type])->with(['taxonomy'=>function($query){
            /** @var $query ActiveQuery */
            $query->select(['id', 'parent_id', 'category_id', 'name']);
        }])->asArray();

        return Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $query,
            'pagination' => [
                'pagesize' => $this->pageSize_index,
            ],
        ]);
    }

    /**
     * 单个内容对象
     * @param $id
     * @return array
     */
    public function one($id) {
        Content::updateAllCounters(['view_count' => 1], ['id' => $id]);

        /** @var Content $object */
        $object = Content::find()->published()->normalSelect()->where(['id' => $id])->one();
        $data = $object->toArray();
        $data[ 'taxonomy' ] = $object->taxonomy;
        $data[ 'body' ] = $object->body;

        return $data;
    }


}