<?php
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \source\core\front\FrontView */

if (!\Yii::$app->user->isGuest): ?>
<!--
    <div class="user-panel">
        <div class="pull-left info">
            <p><?= \Yii::$app->user->identity->username ?></p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
-->
<?php endif; ?>


<!-- search form -->
<!--<form action="#" method="get" class="sidebar-form">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..."/>
        <span class="input-group-btn">
            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>-->
<!-- /.search form -->


<?php

$menuItems = [];

$favouriteMenuItems[] = ['label'=>'MAIN NAVIGATION', 'options'=>['class'=>'header']];
$developerMenuItems = [];
$activeUrl = Url::to(['/'.app()->request->pathInfo]);

/**
 * @param \source\modules\menu\models\Menu $menu
 * @param bool $isSubMenu
 * @return array
 */
$renderItem = function($menu, $isSubMenu = FALSE) use ($activeUrl, &$renderItem) {
    $targetUrl = Url::to([$menu->url]);
    $active = (strpos($activeUrl, $targetUrl) === 0);

    $defaultItem = [
        'icon'    => $menu->icon,
        'label'   => $menu->name,
        'url'     => [$menu->url],
        'visible' => TRUE,
        'active'  => $active,
        'items'   => []
    ];

    if(count($menu->subMenu) > 0){
        foreach ($menu->subMenu as $subMenu){
            $result = $renderItem($subMenu, TRUE);
            if($defaultItem['active'] !== TRUE && $result['active'] === TRUE){
                $defaultItem['active'] = TRUE; }
            $defaultItem['items'][] = $result;
        }
    }

    return $defaultItem;
};

/** @var \source\modules\menu\models\Menu[] $menus */
$menus = app()->menu->getTree('admin', 0, FALSE);
foreach ($menus as $menu){
    $menuItems[] = $renderItem($menu);
}
//exit();
if (!Yii::$app->user->isGuest) {
    $menuItems[] = [
        'url' => '#',
        'icon' => '<i class="fa fa-cog"></i>',
        'label'   => 'Developer',
        'items'   => $developerMenuItems,
        'options' => ['class' => 'treeview'],
        'visible' => !Yii::$app->user->isGuest
    ];
}
echo \source\core\widgets\Menu::widget([
    'options' => ['class' => 'sidebar-menu'],
    'items' => \yii\helpers\ArrayHelper::merge($favouriteMenuItems, $menuItems),
]);
?>
