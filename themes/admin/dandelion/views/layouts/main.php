<?php
use source\LuLu;
\themes\admin\dandelion\MainAsset::register($this);
/* @var $this \source\core\front\FrontView */
/* @var $content string */
$this->beginPage(); ?>
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
    <title><?php echo $this->title ?> - <?php echo app()->config()->get('site_name') ?></title>
    <?php $this->head() ?>
    <style>
        body{ background: none!important; }
    </style>
</head>

<body>
<?php $this->beginBody() ?>

<?php if (LuLu::getViewParam('defaultLayout') === NULL): ?>
    <div class="grid_4">
        <div class="da-panel">
            <div class="da-panel-header">
                <div class="da-panel-title">
                    <img src="<?= $this->assetsUrl('images/icons/black/16/pencil.png') ?>" alt="">
                    <?= $this->title ?>
                </div>
            </div>
            <?php if (($toolbars = LuLu::getViewParam('toolbars')) !== NULL): ?>
                <div class="da-panel-toolbar top">
                    <ul>
                        <?php foreach ($toolbars as $bar): ?>
                            <li><?php echo $bar; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="da-panel-content">
                <?php echo $content ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <?php echo $content ?>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>

<?php $this->endPage() ?>
