<?php
/**
 * User: BrandonXu
 * Date: 2017/9/11
 * Time: 1:11
 */

namespace themes\admin\AdminLTE\assets;

use source\assets\BaseAssets;
use yii\web\View;

class BowerAsset extends BaseAssets
{

    const SELECT2 = 'select2';
    const SLIM_SCROLL = 'slimScroll';

    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';

    public $jsOptions = [
        'position' => View::POS_END
    ];

    /**
     * @param $name
     * @param View $view
     */
    public static function registerBower($name, $view){
        $self = new self;

        $files = $self->returnBowerFiles($name);
        if(!empty($files)){
            $self->sourcePath .= "/{$name}";
            $self->publish(app()->assetManager);
            $self->css = isset($files['css']) ? $files['css'] : [];
            $self->js  = isset($files['js'])  ? $files['js']  : [];
            $self->registerAssetFiles($view);
        }
    }

    public function returnBowerFiles($name){
        $list = [
            self::SELECT2 => [
                'css' => [
                    'select2.min.css'
                ],
                'js'  => [
                    //'select2.min.js'
                ]
            ],
            self::SLIM_SCROLL => [
                'js' => [
                    'jquery.slimscroll.min.js'
                ]
            ]
        ];
        if(isset($list[$name])){
            return $list[$name];
        }
        return [];
    }

}