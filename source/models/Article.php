<?php
/**
 * Created by PhpStorm.
 * User: BrandonXu
 * Date: 2017/8/13
 * Time: 22:58
 */

namespace source\models;


class Article
{

    public function getId(){
        return 100;
    }

    public function getContent($writer){
        return 'this is an article, writer is ' . $writer;
    }
}