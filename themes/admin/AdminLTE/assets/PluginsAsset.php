<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 1:11
 */

namespace themes\admin\AdminLTE\assets;

use source\assets\BaseAssets;
use source\core\base\BaseView;
use yii\web\View;

class PluginsAsset extends BaseAssets
{

    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

    public $css = [

    ];

    public $js = [

    ];

    public $jsOptions = [
        'position' => View::POS_HEAD
    ];

}