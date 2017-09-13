<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 1:11
 */

namespace themes\admin\dandelion;

use source\assets\BaseAssets;

class LoginAsset extends BaseAssets
{

    public $sourcePath = '@themes/admin/dandelion/assets';

    public $css = [
        'css/reset.css',
        'css/fluid.css',
        'css/login.css',
        'plugins/tipsy/tipsy.css',
    ];

    public $js = [
        'js/core/dandelion.login.js',
        'plugins/placeholder/jquery.placeholder.js',
        'plugins/validate/jquery.validate.min.js',
        'plugins/fileinput/jquery.fileinput.js',
        'plugins/placeholder/jquery.placeholder.js',
        'plugins/mousewheel/jquery.mousewheel.js',
        'plugins/tinyscrollbar/jquery.tinyscrollbar.min.js',
        'plugins/tipsy/jquery.tipsy-min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}