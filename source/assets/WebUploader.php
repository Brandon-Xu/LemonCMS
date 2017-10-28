<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/10/24
 * Time: 19:20
 */

namespace source\assets;


class WebUploader extends BaseAssets
{

    public $sourcePath = '@bower/fex-webuploader/dist';

    public $css = [
        'webuploader.css'
    ];

    public $js = [
        'webuploader.min.js'
    ];
}