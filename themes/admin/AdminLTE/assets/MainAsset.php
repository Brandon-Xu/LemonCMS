<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 1:11
 */

namespace themes\admin\AdminLTE\assets;

use source\assets\BaseAssets;
use yii\web\View;

class MainAsset extends BaseAssets
{

    public $sourcePath = '@themes/admin/AdminLTE/assets/normal';

    public $css = [
        'normal.css',
    ];

    public $js = [

    ];

    public $depends = [
        'dmstr\web\AdminLteAsset',
        'source\assets\IonIcons'
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD
    ];

}