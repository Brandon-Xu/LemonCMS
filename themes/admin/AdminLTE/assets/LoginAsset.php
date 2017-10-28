<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 1:11
 */

namespace themes\admin\AdminLTE\assets;

use source\assets\BaseAssets;

class LoginAsset extends BaseAssets
{

    public $sourcePath = '@themes/admin/AdminLTE/assets';

    public $css = [

    ];

    public $js = [

    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}