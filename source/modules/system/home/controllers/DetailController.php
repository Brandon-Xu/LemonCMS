<?php

namespace source\modules\system\home;

use frontend\controllers\ContentController;
use source\models\Content;


class DetailController extends BaseController
{

    public function actionIndex($id) {
        Content::updateAllCounters(['views' => 1], ['id' => $id]);
        $model = Content::findOne(['id' => $id]);

        return $this->render('index', ['model' => $model]);
    }

}
