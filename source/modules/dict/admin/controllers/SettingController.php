<?php

namespace source\modules\dict\admin\controllers;

use source\modules\admin\controllers\BaseSettingController;
use source\modules\dict\models\Setting;

class SettingController extends BaseSettingController
{
    public function actionIndex() {
        $model = new Setting();

        return $this->doConfig($model);
    }
}
