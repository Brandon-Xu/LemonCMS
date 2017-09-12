<?php

namespace source\libs;

use Yii;
use source\modules\theme\ThemeInfo;
use source\helpers\FileHelper;
use source\models\Config;

class Resource
{
    public static function getInstallUrl($url = NULL) {
        $ret = Yii::getAlias('@web/install');
        if ($url != NULL) {
            return $ret.$url;
        }
        return $ret;
    }
}

