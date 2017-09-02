<?php
/**
 * User: BrandonXu
 * Date: 2017/8/31
 * Time: 18:05
 */

function app() {
    return \Yii::$app;
}

function dd($d) {
    \yii\helpers\VarDumper::dump($d, 999, TRUE);
    exit;
}