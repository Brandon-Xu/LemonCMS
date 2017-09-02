<?php

namespace source\modules\log\admin\controllers;

use source\modules\log\models\Setting;

class SettingController extends \backend\controllers\BaseSettingController
{
    public function actionIndex() {
        $model = new Setting();

        return $this->doConfig($model);
    }
}
