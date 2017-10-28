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
use yii\web\View;

class BaseAssets extends AssetBundle {

    public static function getBaseUrl(){
        $item = new static();
        $item->publish(app()->assetManager);
        return $item->baseUrl;
    }
    /**
     * @param FrontView|View $view
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

    /**
     * 定义按需加载JS方法，注意加载顺序在最后
     * @param View $view
     * @param $js
     */
    public static function addScript($view, $js) {
        $view->registerJsFile($js);
    }

    //
    /**
     * 定义按需加载css方法，注意加载顺序在最后
     * @param View $view
     * @param $css
     */
    public static function addCss($view, $css) {
        $view->registerCssFile($css);
    }
}