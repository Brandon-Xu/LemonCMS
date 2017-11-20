<?php
/** @var source\core\base\BaseView $this */
$seoTitle = $this->config()->get('seo_title');
$siteName = $this->config()->get('site_name');
$title = empty($seoTitle) ? $siteName : $seoTitle;
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="renderer" content="webkit">
        <meta name="keywords" content="<?= $this->config()->get('seo_keywords') ?>">
        <meta name="description" content="<?= $this->config()->get('seo_description') ?>">
        <link rel="shortcut icon" href="/favicon.ico"/>
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="/dist/src/assets/bower_components/yeti/bootstrap.theme.min.css">
        <?php $this->head() ?>
        <title><?= $title?></title>
    </head>

    <body>
    <?php $this->beginBody() ?>
    <div id="app"></div>
    <?php $this->endBody() ?>
    <script src="/dist/main.js"></script>
    </body>
    </html>
<?php $this->endPage() ?>