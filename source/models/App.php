<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/8/14
 * Time: 0:06
 */

namespace source\models;


class App
{

    public static function get($key){
        $value = null;
        if(app()->request->isPost){
            $value = app()->request->post($key);
        }
        if(app()->request->isGet){
            $value = app()->request->get($key);
        }
        return $value;
    }

    public static function getData(){
        return self::get('d');
    }

    public function getTitle(){
        return 'rest-full API test';
    }

    public static function find(){
        return '123';
    }
}

