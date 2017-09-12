<?php

namespace source\modules\theme\admin\controllers;

use source\modules\theme\models\Setting;

class SettingController extends \source\modules\admin\controllers\BaseSettingController
{
    public function actionIndex() {
        $model = new Setting();

        return $this->doConfig($model);
    }
}
