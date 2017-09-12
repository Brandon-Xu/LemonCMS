<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 1:11
 */

namespace themes\home\fengyun;

use source\assets\BaseAssets;

class MainAssets extends BaseAssets
{

    public $sourcePath = '@themes/home/fengyun/assets';

    public $css = [
        'css/base1.css',
        'css/style.css',
        'css/fonts/font-awesome.min.css',
    ];

    public $js = [
        'js/jquery.min.js',
        'js/jquery-migrate.min.js',
        'js/jquery.dropkick.min.js',
        'js/news_top.js',
        'js/scrolltop.js',
        'js/scripts.js'
    ];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}