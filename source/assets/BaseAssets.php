<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 23:28
 */
namespace source\assets;

use source\core\front\FrontView;
use yii\helpers\Url;
use yii\web\AssetBundle;

class BaseAssets extends AssetBundle {

    public static function getBaseUrl(){
        $item = new static();
        $item->publish(app()->assetManager);
        return $item->baseUrl;
    }
    /**
     * @param FrontView $view
     * @return AssetBundle
     */
    public static function register($view){
        $bundle = parent::register($view);
        $view->themeBundle = $bundle;
        return $bundle;
    }

    public static function url($to){
        return Url::to(self::getBaseUrl().$to);
    }
}