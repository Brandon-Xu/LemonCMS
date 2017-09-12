<?php

namespace source\modules\tools\admin\controllers;

use source\modules\admin\controllers\BaseSettingController;
use source\modules\tools\models\Setting;

class SettingController extends BaseSettingController
{
    public function actionIndex() {
        $model = new Setting();

        return $this->doConfig($model);
    }
}
