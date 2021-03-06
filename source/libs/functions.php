<?php
/**
 * User: BrandonXu
 * Date: 2017/8/31
 * Time: 18:05
 * @return \source\core\base\BaseApplication|yii\console\Application|yii\web\Application
 */
function app() {
    return \Yii::$app;
}

function dd(...$args){
    \yii\helpers\VarDumper::dump($args, 999, TRUE);
    die(1);
}

class diffTime{

    private static $beginTime = 0;

    public static function begin(){
        self::$beginTime = microtime(true); #获取程序开始执行的时间
    }

    public static function end($exit = FALSE){
        $etime = microtime(true); #获取程序执行结束的时间
        $total = $etime - self::$beginTime;   #计算差值
        if($exit) {
            echo $total;
            app()->end();
        }
        return $total;
    }
}