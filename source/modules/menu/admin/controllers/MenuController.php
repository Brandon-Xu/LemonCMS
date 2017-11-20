<?php

namespace source\modules\menu\admin\controllers;

use source\core\base\BackController;
use source\modules\menu\models\Menu;
use source\modules\menu\models\search\MenuSearch;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

/**
 * DefaultController implements the CRUD actions for Menu model.
 */
class MenuController extends BackController
{

    /**
     * Lists all Menu models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new MenuSearch();
        $searchModel->parent_id = 0;
        $dataProvider = $searchModel->search([
            $searchModel->formName() => app()->request->queryParams
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Menu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($category) {
        $model = new Menu();
        $model->loadDefaultValues();
        $model->category_id = $category;
        $url  = app()->request->get('url', NULL);
        $name = app()->request->get('name', NULL);

        if($name !== NULL && $url !== NULL){
            $model->url = $url;
            $model->name = $name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'category' => $category]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $category = $model->category_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'category' => $category]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Menu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $category = $model->category_id;
        $model->delete();

        return $this->redirect(['index', 'category' => $category]);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Menu::findOne($id)) !== NULL) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
