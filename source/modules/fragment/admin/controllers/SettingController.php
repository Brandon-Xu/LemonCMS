<?php

namespace source\modules\fragment\admin\controllers;

use source\modules\fragment\models\Setting;

class SettingController extends \source\modules\admin\controllers\BaseSettingController
{
    public function actionIndex() {
        $model = new Setting();

        return $this->doConfig($model);
    }
}
