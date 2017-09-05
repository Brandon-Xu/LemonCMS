<?php
use yii\web\View;
use yii\helpers\Html;
use source\LuLu;
/* @var $this yii\web\View */

$this->title='系统信息';

?>

<table  class="da-table">
    <tbody>
        <tr>
            <td>Yii交流社区</td>
            <td><a href="http://www.yiichina.com/" target="_blank"> Yii交流社区</a></td>
        </tr>   
        <tr>
            <td>LemonCMS下载</td>
            <td><a href="https://github.com/Brandon-Xu/LemonCMS" target="_blank">LemonCMS(Git下载)</a></td>
        </tr>
        <tr>
            <td>Yii 版本</td>
            <td><?php echo LuLu::getVersion(); ?></td>
        </tr>
    	<tr>
            <td>操作系统</td>
            <td><?php echo php_uname('s'); ?> <?php echo php_uname('r'); ?></td>
        </tr>
        <tr>
            <td>PHP 版本</td>
            <td><?php echo PHP_VERSION; ?></td>
        </tr>
        <tr>
            <td>MySQL 版本</td>
            <td><?php echo LuLu::$app->db->pdo->getAttribute(PDO::ATTR_SERVER_VERSION); ?></td>
        </tr>
        
                                 
    </tbody>
</table>