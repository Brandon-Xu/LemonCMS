<?php

namespace source\libs;

use source\modules\theme\ThemeInfo;
use Yii;
use source\helpers\FileHelper;
use source\models\Config;

class Resource
{

    public static function registerFile($url) {
        $dot = stripos($url, '.css');
        if ($dot > 0) {
            echo '<link type="text/css" rel="stylesheet" href="'.$url.'" />'."\n";
        } else {
            echo '<script type="text/javascript" src="'.$url.'" ></script>'."\n";
        }
    }

    public static function getAdminTheme() {
        $currentTheme = Config::get('theme_admin', ThemeInfo::getId());

        return $currentTheme;
    }

    public static function getHomeTheme() {
        $currentTheme = Config::get('theme_home', ThemeInfo::getId());

        return $currentTheme;
    }

    public static function getCommonPath($path = NULL) {
        $ret = Yii::getAlias('@webroot/statics/common');
        if ($path != NULL) {
            return $ret.$path;
        }

        return $ret;
    }

    public static function getCommonUrl($url = NULL) {
        $ret = Yii::getAlias('@web/statics/common');
        if ($url != NULL) {
            return $ret.$url;
        }

        return $ret;
    }

    public static function registerCommon($url) {
        $url = self::getCommonUrl($url);
        self::registerFile($url);
    }

    public static function getAdminPath($path = NULL) {
        $currentTheme = self::getAdminTheme();
        $ret = '@webroot/statics/admin/'.$currentTheme;
        if ($path != NULL) {
            return $ret.$path;
        }

        return $ret;
    }

    public static function getAdminUrl($url = NULL) {
        $currentTheme = self::getAdminTheme();
        $ret = Yii::getAlias('@web/statics/admin/'.$currentTheme);
        if ($url != NULL) {
            return $ret.$url;
        }

        return $ret;
    }

    public static function registerAdmin($url) {
        if (is_array($url)) {
            foreach ($url as $u) {
                $u = self::getAdminUrl($u);
                self::registerFile($u);
            }
        } else {
            $url = self::getAdminUrl($url);
            self::registerFile($url);
        }
    }

    public static function getThemePath($path = NULL) {
        $currentTheme = self::getHomeTheme();
        $ret = '@webroot/statics/themes/'.$currentTheme;
        if ($path != NULL) {
            return $ret.$path;
        }

        return $ret;
    }

    public static function getThemeUrl($url = NULL) {
        $currentTheme = self::getHomeTheme();
        $ret = Yii::getAlias('@web/statics/themes/'.$currentTheme);
        if ($url != NULL) {
            return $ret.$url;
        }

        return $ret;
    }

    public static function registerTheme($url) {
        $url = self::getThemeUrl($url);
        self::registerFile($url);
    }

    public static function getContentItemView($content) {
        $currentTheme = self::getHomeTheme();
        $ret = '@webroot/statics/themes/'.$currentTheme.'/modules/'.$content['type'].'/_inc/content_default';

        return $ret;
    }

    public static function checkHomeThemeFile($fileName, $checkDefault = TRUE) {
        $currentTheme = Resource::getHomeTheme();

        $path = Yii::getAlias('statics').'/themes/'.$currentTheme.$fileName.'.php';
        if (!FileHelper::exist($path) && $checkDefault) {
            $currentTheme = 'd';
            $path = Yii::getAlias('statics').'/themes/'.$currentTheme.$fileName.'.php';
        } else {
            return $currentTheme;
        }
        if (!FileHelper::exist($path)) {
            return FALSE;
        }

        return $currentTheme;
    }

    public static function getInstallPath($path = NULL) {
        $ret = '@webroot/statics/install';
        if ($path != NULL) {
            return $ret.$path;
        }

        return $ret;
    }

    public static function getInstallUrl($url = NULL) {
        $ret = Yii::getAlias('@web/statics/install');
        if ($url != NULL) {
            return $ret.$url;
        }

        return $ret;
    }
}

