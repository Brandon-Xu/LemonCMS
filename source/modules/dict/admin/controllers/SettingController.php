<?php

namespace source\modules\dict\admin\controllers;

use backend\controllers\BaseSettingController;
use source\modules\dict\models\Setting;

class SettingController extends BaseSettingController
{
    public function actionIndex()
    {
        $model = new Setting();
        
        return $this->doConfig($model);
    }
}
