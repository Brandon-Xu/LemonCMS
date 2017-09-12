<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 1:11
 */

namespace themes\admin\dandelion;

use source\assets\BaseAssets;

class MainAssets extends BaseAssets
{

    public $sourcePath = '@themes/admin/dandelion/assets';

    public $css = [
        'css/reset.css',
        'css/fluid.css',
        'css/dandelion.theme.css',
        'css/dandelion.css',
        'css/demo.css',

        'plugins/jui/css/jquery.ui.all.css',
        'plugins/tipsy/tipsy.css',
    ];

    public $js = [
        'js/jquery-1.7.2.min.js',

        'plugins/jui/js/jquery-ui-1.8.20.min.js',
        'plugins/jui/js/jquery.ui.timepicker.min.js',
        'plugins/jui/js/jquery.ui.touch-punch.min.js',

        'plugins/fileinput/jquery.fileinput.js',
        'plugins/placeholder/jquery.placeholder.js',
        'plugins/mousewheel/jquery.mousewheel.js',
        'plugins/tinyscrollbar/jquery.tinyscrollbar.min.js',
        'plugins/tipsy/jquery.tipsy-min.js',

        'js/demo/demo.validation.js',
        'js/demo/demo.ui.js',
        'js/demo/demo.tables.js',

        'js/core/dandelion.core.js',
        'js/core/dandelion.customizer.js',
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}