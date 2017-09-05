<?php

namespace source\modules\tools\admin\controllers;

use Yii;
use source\LuLu;
use source\modules\tools\models\CacheForm;
use source\core\back\BackController;

class CacheController extends BackController
{
    public function actionIndex() {
        $model = new CacheForm();

        if (app()->request->isPost && $model->load(app()->request->post())) {
            if ($model->cache) {
                app()->cache->flush();
                app()->schemaCache->flush();
            }

            if ($model->asset) {
                $assetDir = Yii::getAlias('@statics/assets');
                //FileHelper::removeDirectoryContent($assetDir);
            }

            return $this->redirect(['index']);
        }

        return $this->render('index', ['model' => $model]);
    }
}
