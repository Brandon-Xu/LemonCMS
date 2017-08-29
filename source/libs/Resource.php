<?php

namespace source\libs;

use source\LuLu;
use yii\helpers\FileHelper;

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
        $currentTheme = Common::getConfigValue('sys_theme_admin');

        return $currentTheme;
    }

    public static function getHomeTheme() {
        $currentTheme = Common::getConfigValue('sys_theme_home');

        return $currentTheme;
    }

    public static function getCommonPath($path = NULL) {
        $ret = LuLu::getAlias('@webroot/statics/common');
        if ($path != NULL) {
            return $ret.$path;
        }

        return $ret;
    }

    public static function getCommonUrl($url = NULL) {
        $ret = LuLu::getAlias('@web/statics/common');
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
        $ret = LuLu::getAlias('@web/statics/admin/'.$currentTheme);
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
        $ret = LuLu::getAlias('@web/statics/themes/'.$currentTheme);
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
        $ret = '@webroot/statics/themes/'.$currentTheme.'/modules/'.$content[ 'type' ].'/_inc/content_default';

        return $ret;
    }

    public static function checkHomeThemeFile($fileName, $checkDefault = TRUE) {
        $currentTheme = Resource::getHomeTheme();

        $path = LuLu::getAlias('statics').'/themes/'.$currentTheme.$fileName.'.php';
        if (!FileHelper::exist($path) && $checkDefault) {
            $currentTheme = 'd';
            $path = LuLu::getAlias('statics').'/themes/'.$currentTheme.$fileName.'.php';
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
        $ret = LuLu::getAlias('@web/statics/install');
        if ($url != NULL) {
            return $ret.$url;
        }

        return $ret;
    }
}

