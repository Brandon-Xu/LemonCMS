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

    /**
     *
     * -path
     * -url
     * -name
     * -new_name
     * -temp_name
     * -type
     * -ext
     * -size
     * -message
     *
     * @param string $name the form name
     * @return array
     */
    public static function uploadFile($name) {
        LuLu::info($name, __METHOD__.',the form name is '.$name);
        $uploadedFile = UploadedFile::getInstanceByName($name);

        if ($uploadedFile === NULL) {
            return ['message' => '没有文件'];
        }

        if ($uploadedFile->hasError) {
            switch ($uploadedFile->error) {
                case '1':
                    $error = '超过php.ini允许的大小。';
                    break;
                case '2':
                    $error = '超过表单允许的大小。';
                    break;
                case '3':
                    $error = '图片只有部分被上传。';
                    break;
                case '4':
                    $error = '请选择图片。';
                    break;
                case '6':
                    $error = '找不到临时目录。';
                    break;
                case '7':
                    $error = '写文件到硬盘出错。';
                    break;
                case '8':
                    $error = 'File upload stopped by extension。';
                    break;
                case '999':
                default:
                    $error = '未知错误。';
            }
            LuLu::error($error, '上传文件出错');
            return ['message' => $error];
        }

        $ymd = date("Ymd");

        $save_path = \Yii::getAlias('@attachment').'/'.$ymd."/";
        $save_url = 'attachment/'.$ymd."/";

        if (!file_exists($save_path)) {
            mkdir($save_path);
        }

        $file_name = $uploadedFile->getBaseName();
        $file_ext = $uploadedFile->getExtension();

        // 新文件名
        $new_file_name = date("YmdHis").'_'.rand(10000, 99999).'.'.$file_ext;
        $uploadedFile->saveAs($save_path.$new_file_name);

        return [
            'path' => $save_path,
            'url' => $save_url,
            'name' => $file_name,
            'new_name' => $new_file_name,
            'ext' => $file_ext,
            'full_name' => $save_url.$new_file_name,
            'temp_name' => $uploadedFile->tempName,
            'type' => $uploadedFile->type,
            'size' => $uploadedFile->size,
            'message' => 'ok',
        ];
    }


}
