<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use source\modules\taxonomy\models\Taxonomy;
use source\libs\Resource;
use source\LuLu;
use yii\helpers\Url;
use source\modules\menu\models\Menu;

/* @var $this \source\core\base\BaseView */
/* @var $content string */

$rbacService = $this->rbac;

if($message = LuLu::getFlash('error')):?>
    <div class="da-message error">
        <?php if(is_array($message)) {
            echo '<ul>';
            foreach ($message as $item) {
                echo '<li>'.$item.'</li>';
            }
            echo '</ul>';
        } else {
            echo $message;
        } ?>
    </div>
<?php endif;?>
