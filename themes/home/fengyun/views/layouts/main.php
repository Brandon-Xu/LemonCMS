<?php
\themes\home\fengyun\MainAssets::register($this);
/** @var source\core\base\BaseView $this */
$title = $this->config()->get('seo_title');
if (empty($title)) {
    $title = $this->config()->get('site_name');
}
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->title ?> — <?php echo $title ?></title>
        <meta name="keywords" content="<?php echo $this->config()->get('seo_keywords') ?>">
        <meta name="description" content="<?php echo $this->config()->get('seo_description') ?>">
        <link rel="shortcut icon" href="favicon.ico"/>
        <?php $this->head() ?>
        <style type="text/css" id="custom-background-css">
            body.custom-background {
                background-color: #f0f0f0;
            }
        </style>
    </head>

    <body class="home blog custom-background chrome">
    <?php $this->beginBody() ?>
    <?= $this->render('header'); ?>

    <div class="col-md-8 content-area" role="main">
        <?php echo $content; ?>
    </div>

    <?php if (isset($this->blocks['sidebar'])): ?>
        <div class="col-md-4 site-sidebar" role="complementary">
            <?php echo $this->blocks['sidebar']; ?>
        </div>
    <?php else: ?>
        <?php echo $this->render('//_inc/sidebar'); ?>
    <?php endif; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

<?php echo $this->render('footer'); ?>