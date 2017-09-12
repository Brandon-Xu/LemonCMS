<?php
/**
 * User: BrandonXu
 * Date: 2017/8/31
 * Time: 18:05
 */

/**
 * @return \source\core\base\BaseApplication|yii\console\Application|yii\web\Application
 */
function app() {
    return \Yii::$app;
}

function dd($d, $exit = TRUE) {
    \yii\helpers\VarDumper::dump($d, 999, TRUE);
    if($exit){ exit; }
}