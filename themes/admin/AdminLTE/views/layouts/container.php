<?php
use yii\helpers\Html;

/* @var $this \source\core\front\FrontView */
/* @var $content string */
$rbacService = \source\LuLu::getService('rbac');
\themes\admin\AdminLTE\assets\MainAsset::register($this);
\themes\admin\AdminLTE\assets\BowerAsset::registerBower('slimScroll', $this);
$this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= app()->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta http-equiv="Content-Type" content="text/html" charset="<?= app()->charset ?>"/>
    <title><?php echo Html::encode($this->title.' - '.app()->config()->get('site_name')) ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php $this->head() ?>
    <style>
        .pjax-widgets-block {
            min-height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body class="hold-transition fixed skin-blue sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <header class="main-header">
        <a href="<?= \Yii::$app->homeUrl ?>" class="logo"><?= Html::encode($this->config()
                    ->get('site_name').' Dashboard') ?></a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php if (!\Yii::$app->user->isGuest): ?>
                        <li class="dropdown messages-menu" style="display: none;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 1 notification(s)</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> Welcome to Phundament 4!
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?= \Yii::$app->user->identity->username ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <p>
                                        <?= \Yii::$app->user->identity->username ?>
                                        <small><?= \Yii::$app->user->identity->email ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= \yii\helpers\Url::to(['/user/settings/profile']) ?>"
                                           class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= \yii\helpers\Url::to(['/user/security/logout']) ?>"
                                           class="btn btn-default btn-flat" data-method="post">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <?= $content ?>

    <footer class="main-footer">
        Powered by <strong><a href="mailto:lemonxl1994@gmail.com">Brandon.Xu</a></strong>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

