<?php

namespace source\modules\taxonomy\admin\controllers;

use source\core\base\BackController;
use source\modules\taxonomy\models\search\TaxonomySearch;
use source\modules\taxonomy\models\Taxonomy;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

/**
 * TaxonomyController implements the CRUD actions for Taxonomy model.
 */
class TaxonomyController extends BackController
{

    /**
     * Lists all Taxonomy models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaxonomySearch();
        $searchModel->parent_id = 0;
        $dataProvider = $searchModel->search([
            $searchModel->formName() => app()->request->queryParams
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel, 'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Taxonomy model.
     * @param integer $id
     * @param string $type
     * @return mixed
     */
    public function actionView($id, $type) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Taxonomy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param $category
     * @return mixed
     */
    public function actionCreate($category) {
        $model = new Taxonomy();
        $model->category_id = $category;
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'index', 'category' => $category,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Taxonomy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $category = $model->category_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'index', 'category' => $category,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Taxonomy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $model->delete();
        $category = $model->category_id;

        return $this->redirect([
            'index', 'category' => $category,
        ]);
    }

    /**
     * Finds the Taxonomy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Taxonomy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Taxonomy::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
