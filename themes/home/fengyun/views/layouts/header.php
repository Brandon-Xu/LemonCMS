<div class="site-top">
    <div class="clearfix container">
        <div class="site-branding">
            <h1 class="site-title"><a href="<?php echo $this->getHomeUrl() ?>" rel="home"
                                      title="<?php echo $this->config()->get('site_name'); ?>">
                    <?php echo $this->config()->get('site_name'); ?></a></h1>
        </div>
        <nav class="site-menu" role="navigation">
            <div class="menu-toggle"><i class="fa fa-bars"></i></div>
            <div class="menu-text"></div>
            <div class="clearfix menu-bar">
                <ul id="menu-main" class="menu">

                    <?php $this->renderMenu('main'); ?>
                    <li id="menu-item-yiifans"
                        class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-yiifans"><a
                                href="http://www.yiifans.com" target="_blank">Yii2 交流社区</a></li>
                </ul>
            </div>
            <!-- .site-menu -->
        </nav>

        <div class="site-search">
            <div class="search-toggle"><i class="fa fa-search"></i></div>
            <div class="search-expand">
                <div class="search-expand-inner">

                </div>
            </div>
            <!-- .site-search -->
        </div>
    </div>
    <!-- .site-top -->
</div>
<div class="site-main">
    <div class="clearfix container">
        <div class="row">
