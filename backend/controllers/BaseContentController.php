<?php

namespace backend\controllers;

use source\core\back\BackController;
use source\LuLu;
use source\models\Content;
use source\models\search\ContentSearch;
use Yii;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;

abstract class BaseContentController extends BackController
{

    protected $content_type;

    protected $bodyClass;

    protected $bodyModel;

    public function actionIndex() {
        $searchModel = new ContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere([
            'content_type' => $this->content_type,
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel, 'dataProvider' => $dataProvider,
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

        if ($this->saveContent($model, $bodyModel)) {
            return $this->redirect([
                'index',
            ]);
        }

        return $this->render('create', [
            'model' => $model, 'bodyModel' => $bodyModel,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $bodyModel = $this->findBodyModel($id);

        if ($this->saveContent($model, $bodyModel)) {
            return $this->redirect([
                'index',
            ]);
        }

        return $this->render('update', [
            'model' => $model, 'bodyModel' => $bodyModel,
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
     * @return array|null|\source\models\ContentBody|static
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
     * @param $model \source\models\ContentBody
     * @param $bodyModel \source\models\ContentBody
     * @return bool
     */
    public function saveContent($model, $bodyModel) {
        $postDatas = Yii::$app->request->post();

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
     * @param $model \source\models\ContentBody
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
