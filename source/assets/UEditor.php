<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/10/17
 * Time: 16:37
 */

namespace source\assets;

use kucha\ueditor\UEditorAsset;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

class UEditor extends \kucha\ueditor\UEditor
{
    /**
     * 注册客户端脚本
     */
    protected function registerClientScript()
    {
        $bundle = UEditorAsset::register($this->view);
        $this->clientOptions['serverUrl'] = Url::to(['UEDUpload']);
        $clientOptions = Json::encode($this->clientOptions);
        $script = "UE.getEditor('" . $this->id . "', " . $clientOptions . ");";
        $this->view->registerJs($script, View::POS_READY);
        $script = "window.UEDITOR_HOME_URL = \"{$bundle->baseUrl}/\";";
        $this->view->registerJs($script, View::POS_BEGIN);
    }
}