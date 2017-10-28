<?php

namespace source\modules\admin\controllers;

use source\core\back\BackController;
use source\helpers\StringHelper;
use source\LuLu;
use source\models\Content;
use source\models\search\ContentSearch;
use Yii;
use yii\web\NotFoundHttpException;

abstract class BaseContentController extends BackController
{
    public $enableCsrfValidation = FALSE;

    protected $content_type;

    protected $bodyClass;

    protected $bodyModel;

    public function actions() {
        $actions = parent::actions();
        $actions['UEDUpload'] = [
            'class' => 'kucha\ueditor\UEditorAction',
            'config' => [
                "imageUrlPrefix"  => app()->urlManager->hostInfo,
                "imageFolderPath" => \Yii::getAlias('@attachment'),
                "imagePathFormat" => "/attachment/{yyyy}{mm}{dd}/{time}{rand:6}",
                "imageRoot" => \Yii::getAlias("@webroot"),
            ],
        ];

        $actions['upload'] = [
            'class' => 'source\core\actions\UploadAction',
        ];
        return $actions;
    }

    public function actionIndex() {
        $searchModel = new ContentSearch();
        $params = app()->request->queryParams;
        $params = isset($params[$searchModel->formName()]) ? $params : [ $searchModel->formName() => $params ];
        $dataProvider = $searchModel->search($params);
        $dataProvider->query->andWhere([
            'content_type' => $this->content_type,
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate() {
        $model = new Content();
        $model->user_id = LuLu::getIdentity()->id;
        $model->user_name = LuLu::getIdentity()->username;
        $model->content_type = $this->content_type;
        $model->loadDefaultValues();

        $bodyModel = $this->findBodyModel();
        $bodyModel->loadDefaultValues();

        if ($this->saveContent($model)) {
            return $this->redirect([
                'index',
            ]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if (app()->request->get('delThumb') == '1'){
            $model->thumb = NULL;
            $model->thumb2 = NULL;
            $model->save(FALSE);
            return $this->redirect(app()->request->referrer);
        }

        if ($this->saveContent($model)) {
            return $this->redirect([
                'index',
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id) {
        $transaction = LuLu::getDB()->beginTransaction();
        try {
            $this->findModel($id)->delete();
            $this->findBodyModel($id)->delete();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
        }

        return $this->redirect([
            'index',
        ]);
    }

    /**
     * @param $id
     * @return \source\models\Content
     * @throws NotFoundHttpException
     */
    protected function findModel($id) {
        if (($model = Content::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param null $contentId
     * @return array|null|\source\models\ContentBody|static
     */
    public function findBodyModel($contentId = NULL) {
        $bodyClass = $this->bodyClass;

        if ($contentId === NULL) {
            return new $bodyClass();
        } else {
            /* @var $bodyClass yii\db\ActiveRecord */
            /* @var $ret \source\models\ContentBody */
            $ret = $bodyClass::findOne([
                'content_id' => $contentId,
            ]);
            if ($ret === NULL) {
                $ret = new $bodyClass();
                $ret->content_id = $contentId;
                $ret->body = '';
                $ret->save();
            }

            return $ret;
        }
    }

    /**
     * @param $model \source\models\Content
     * @return bool
     */
    public function saveContent($model) {
        $postDatas = Yii::$app->request->post();
        $bodyModel = $model->body;

        if ($model->load($postDatas) && $bodyModel->load($postDatas) && $model->validate() && $bodyModel->validate()) {
            $model->summary = $this->getSummary($model, $bodyModel);
            $transaction = LuLu::getDB()->beginTransaction();
            try {
                $model->save(FALSE);
                $bodyModel->content_id = $model->id;
                $bodyModel->save();
                $transaction->commit();

                return TRUE;
            } catch (\Exception $e) {
                $transaction->rollBack();

                return FALSE;
            }
        }

        return FALSE;
    }

    /**
     * @param $model \source\models\Content
     * @param $bodyModel \source\models\ContentBody
     * @return bool
     */
    public function getSummary($model, $bodyModel) {
        if (empty($model->summary)) {
            if ($bodyModel->hasAttribute('body')) {
                $content = strip_tags($bodyModel->body);
                $content = preg_replace('/\s/', '', $content);
                $model->summary = StringHelper::subString($content, 250);
            }
        }

        return $model->summary;
    }
}
