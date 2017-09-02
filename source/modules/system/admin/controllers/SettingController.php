<?php

namespace source\modules\system\admin\controllers;

use backend\controllers\BaseSettingController;
use source\modules\system\models\config\AccessConfig;
use source\modules\system\models\config\BasicConfig;
use source\modules\system\models\config\DatetimeConfig;
use source\modules\system\models\config\SeoConfig;
use source\modules\system\models\config\ThemeConfig;

class SettingController extends BaseSettingController
{

    public function actionBasic() {
        $model = new BasicConfig();

        return $this->doConfig($model);
    }

    public function actionTheme() {
        $model = new ThemeConfig();

        return $this->doConfig($model);
    }

    public function actionEmail() {
        $model = new ThemeConfig();

        return $this->doConfig($model);
    }

    public function actionDatetime() {
        $model = new DatetimeConfig();

        return $this->doConfig($model);
    }

    public function actionAccess() {
        $model = new AccessConfig();

        return $this->doConfig($model);
    }

    public function actionSeo() {
        $model = new SeoConfig();

        return $this->doConfig($model);
    }
}
