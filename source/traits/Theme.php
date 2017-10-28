<?php
/**
 * User: BrandonXu
 * Date: 2017/9/13
 * Time: 2:01
 */
namespace source\traits;

use source\models\Config;
use source\modules\theme\ThemeInfo;
use yii\base\InvalidCallException;
use yii\base\Module;

trait Theme {

    abstract public function beforeAction();

    /**
     * 根据模块的加载情况来设置相应主题，前台模块就加载前台主题，后台模块就加载后台主题
     */
    public function setTheme(){
        $id = $this->getParentModule();
        $themeName = Config::get('theme_'.$id, ThemeInfo::getId());
        $moduleId = app()->controller->module->id;

        $theme      = "@activeTheme";
        $basicTheme = "@activeBaseTheme";
        \Yii::setAlias($theme, "@themes/{$id}/{$themeName}");
        \Yii::setAlias($basicTheme, "@themes/{$id}/basic");

        $config = [
            'pathMap' => [
                // 这个是给普通前台模块做的主题路径替换
                '@app/views' => [
                    "{$theme}/views",
                    "{$basicTheme}/views",
                ],
                // 这个是给系统默认的admin后台模块做的主题路径替换
                "@source/modules/{$id}/views" => [
                    "{$theme}/views",
                ],
                // 这个是给模块的前后台提供主题路径替换的
                "@source/modules/{$moduleId}/{$id}/views" => [
                    "{$theme}/modules/{$moduleId}",
                    "{$basicTheme}/modules/{$moduleId}",
                ],
            ],
            'basePath' => "{$theme}",
        ];
        app()->getView()->theme = new \yii\base\Theme($config);
    }

    /**
     * 获取应用顶部模块 也就是 admin or home
     */
    private $_parent_module_id;
    protected function getParentModule(){
        if($this instanceof Module === FALSE){
            throw new InvalidCallException('Theme Traits must be in used in yii\base\Module and the children');
        }
        if(empty($this->_parent_module_id)){
            $this->_parent_module_id = (in_array($this->id, ['admin', 'home']) ) ? $this->id : $this->module->id; }
        return $this->_parent_module_id;
    }

    protected function isAdminModule(){
        return $this->getParentModule() === 'admin';
    }

    protected function isHomeModule(){
        return $this->getParentModule() === 'home';
    }

}