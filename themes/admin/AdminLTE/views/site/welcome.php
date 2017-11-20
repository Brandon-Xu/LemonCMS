<?php

/* @var $this \source\core\base\BaseView */

$this->title = '系统信息';
$this->toolbar = []; ?>
<div class="box">
    <div class="box-body no-padding">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>技术栈</td>
                <td>
                    <a href="https://github.com/Brandon-Xu/LemonCMS" target="_blank">LemonCMS</a>&nbsp;&nbsp;
                    <a href="https://vuejs.org/" target="_blank">Vue</a>&nbsp;&nbsp;
                    <a href="https://github.com/yiisoft/yii2" target="_blank">Yii2 framework</a>
                </td>
            </tr>
            <tr>
                <td>技术支持</td>
                <td><a href="https://github.com/Brandon-Xu" target="_blank">lemonxl1994@gmail.com (徐磊)</a></td>
            </tr>
            <tr>
                <td>Yii 版本</td>
                <td><?php echo Yii::getVersion(); ?></td>
            </tr>
            <tr>
                <td>操作系统</td>
                <td><?php echo php_uname('s'); ?><?php echo php_uname('r'); ?></td>
            </tr>
            <tr>
                <td>PHP 版本</td>
                <td><?php echo PHP_VERSION; ?></td>
            </tr>
            <tr>
                <td>MySQL 版本</td>
                <td><?php echo app()->db->pdo->getAttribute(PDO::ATTR_SERVER_VERSION); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
