<?php

namespace source\modules\log\admin\controllers;

use source\modules\admin\controllers\BaseSettingController;
use source\modules\log\models\Setting;

class SettingController extends BaseSettingController
{
    public function actionIndex() {
        $model = new Setting();

        return $this->doConfig($model);
    }
}
