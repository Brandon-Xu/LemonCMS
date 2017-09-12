<?php

namespace source\modules\admin\controllers;

use Yii;
use source\core\back\BackController;
use source\models\ConfigForm;
use yii\base\InvalidParamException;

abstract class BaseSettingController extends BackController
{

    public function doConfig($model, $view = NULL) {
        if (!($model instanceof ConfigForm)) {
            throw new InvalidParamException('model must be instance of ConfigForm');
        }

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->refresh();
        } else {
            if ($view === NULL) {
                $view = $this->action->id;
            }

            return $this->render($view, [
                'model' => $model,
            ]);
        }
    }
}
