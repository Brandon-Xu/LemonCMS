<?php

use source\libs\Resource;
use source\LuLu;
use source\modules\menu\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \source\core\front\FrontView */
/* @var $content string */
$rbacService = LuLu::getService('rbac');
\themes\admin\dandelion\MainAssets::register($this);
$this->beginPage() ?>
<!DOCTYPE html>
    <html lang="<?= app()->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="<?= app()->charset ?>"/>
    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- iOS webapp metatags -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>

    <!-- iOS webapp icons -->
    <link rel="apple-touch-icon" href="touch-icon-iphone.png"/>
    <link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png"/>
    <link rel="apple-touch-icon" sizes="114x114" href="touch-icon-retina.png"/>
    <title><?php echo $this->title ?> - <?php echo app()->config()->get('site_name') ?></title>
    <script type="text/javascript">
		function toggleMenu(id) {
			$(".menu-item").hide();
			$("#menu-item-" + id).show();

			$(".da-header-menu-item").removeClass("current");
			$("#menu-" + id).addClass("current");
		}
    </script>
    <style type="text/css">
        html, body { height: 100%; }
        body #da-content #da-sidebar {
            margin: 0 auto;
            width: auto;
            display: table;
            float: none;
            position: inherit;
            z-index: auto;
        }
    </style>
    <?php $this->head() ?>
</head>

<body onresize="iFrameHeight();">
<?php $this->beginBody() ?>

<table style="width: 100%; height: 100%; margin:0;" id="tableLayout">
    <tr>
        <td>
            <!-- Header -->
            <div id="da-header">
                <div id="da-header-top">
                    <!-- Container -->
                    <div class="da-container clearfix">
                        <!-- Logo Container. All images put here will be vertically centere -->
                        <div id="da-logo-wrap">
                            <div id="da-logo">
                                <div id="da-logo-img">
                                    <a href="<?=Url::to(['/admin']);?>">
                                        <img src="<?= $this->assetsUrl('images/logo.png') ?>" alt="Dandelion Admin"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="da-header-menu">
                            <?php
                            $isHome = TRUE;
                            foreach (app()->menu->getChildren('admin') as $item) { ?>
                                <div class="da-header-menu-item <?php if ($isHome) {
                                    echo 'current';
                                } ?>" id="menu-<?php echo $item['id'] ?>"
                                     onclick="toggleMenu(<?php echo $item['id'] ?>);"><?php echo $item['name'] ?></div>
                                <?php
                                $isHome = FALSE;
                            } ?>
                        </div>
                        <!-- Header Toolbar Menu -->
                        <!-- Header Toolbar Menu -->
                        <div id="da-header-toolbar" class="clearfix">
                            <div id="da-user-profile">
                                <div id="da-user-avatar">
                                    <img src="<?= $this->assetsUrl('images/pp.jpg') ?>" alt=""/>
                                </div>
                                <div id="da-user-info">
                                    <?php echo app()->user->identity->username ?>
                                </div>
                                <ul class="da-header-dropdown">
                                    <li class="da-dropdown-caret">
                                        <span class="caret-outer"></span>
                                        <span class="caret-inner"></span>
                                    </li>
                                    <li class="da-dropdown-divider"></li>
                                    <li><a href="<?php echo Url::to('/'); ?>" target="_blank">站点首页</a></li>
                                </ul>

                            </div>
                            <div id="da-header-button-container">
                                <ul>
                                    <li class="da-header-button logout">
                                        <?php echo Html::a('退出', ['site/logout']) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td height="100%">
            <table style="width: 100%; height: 100%;margin:10px 0 0 0; padding:0;" id="da-content">
                <tr>
                    <td width="200px">
                        <div id="da-sidebar">

                            <!-- Main Navigation -->
                            <div id="da-main-nav" class="da-button-container">
                                <ul>
                                    <?php echo Menu::getAdminMenu(); ?>
                                </ul>
                            </div>

                        </div>
                    </td>
                    <td>
                        <iframe id="mainFrame" name="mainFrame" width="100%" height="100%"
                                style="overflow: visible;background-color:transparent" frameborder="0" scrolling="yes"
                                allowtransparency="true"
                                src="<?php echo Url::to(['site/welcome']) ?>" onLoad="iFrameHeight()"></iframe>
                        <script type="text/javascript" language="javascript">
							function iFrameHeight() {
								var bodyHeight = document.body.scrollHeight;
								var contentHeight = document.body.scrollHeight - 100;
								console.log(contentHeight);
								//$("#tableLayout").height(bodyHeight);
								var ifm = document.getElementById("mainFrame");
								ifm.height = contentHeight;
								//ifm.height=300;
							}
                        </script>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="40px">
            <!-- Footer -->
            <div id="da-footer">
                <div class="da-container clearfix">
                    <p>
                        Copyright 2012. LemonCMS Admin. All Rights Reserved.</p>
                </div>
            </div>
        </td>
    </tr>
</table>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>