<?php
\themes\home\fengyun\MainAssets::register($this);
/** @var source\core\front\FrontView $this */
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
        <style type="text/css" id="custom-background-css">
            body.custom-background {
                background-color: #f0f0f0;
            }
        </style>
        <?php $this->head() ?>
    </head>

    <body class="home blog custom-background chrome">
    <?php $this->beginBody() ?>
    <?= $this->render('header'); ?>
    <?= $content; ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>

<?php echo $this->render('footer'); ?>