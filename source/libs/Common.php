<?php

namespace source\libs;

use Carbon\Carbon;
use source\LuLu;
use source\models\Config;
use yii\web\UploadedFile;

class Common
{

    public static function init(){
        self::setTimezone();
        if(Config::get('status') === '0') {
            app()->catchAll = ['site/close', 'message' => 'test'];
        }
    }

    public static function classExist($class){
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $classExplode = explode(DIRECTORY_SEPARATOR, $class);
        if(empty($classExplode[0])){
            unset($classExplode[0]); }
        $class = implode(DIRECTORY_SEPARATOR, $classExplode);
        $file = \Yii::getAlias('@app/'.$class.'.php');
        return is_file($file);
    }

    public static function checkInstall($config) {
        if (!isset($config['components']['db']['class'])) {
            exit('<script>top.location.href="install.php"</script>');
        }
    }

    public static function setTimezone() {
        $lang = Config::get('lang');
        if (!Carbon::setLocale($lang)) {
            $lang = explode('-', $lang)[0];
            Carbon::setLocale($lang);
        }

        $timezone = Config::get('datetime_timezone');
        app()->setTimeZone($timezone);

        $datetime_date_format = Config::get('datetime_date_format');
        $datetime_time_format = Config::get('datetime_time_format');

        $format = $datetime_date_format;
        if ($datetime_time_format > 0) {
            switch ($datetime_time_format) {
                case 24:
                    $hour = 'H';
                    break;
                case 12:
                    $hour = 'h';
                    break;
                default:
                    $hour = NULL;
            }
            $timeFormat = $hour === NULL ? '' : " {$hour}:i:s";
            $format = "{$format}{$timeFormat}";
        }
        Carbon::setToStringFormat($format);
    }


}
