<?php
/** @var \source\core\front\FrontView $this */
$this->beginContent('@activeTheme/views/layouts/container.php');

?>
    <aside class="main-sidebar">
        <section class="sidebar">
            <?= $this->render('_sidebar') ?>
        </section>
    </aside>

    <div class="content-wrapper">
        <div style="max-width: 1200px">
            <section class="content-header">
                <h1>
                    <small>&nbsp;<?= $this->title ?> </small>
                </h1>
                <?= yii\widgets\Breadcrumbs::widget([
                    'tag' => 'ol',
                    'links' => $this->breadcrumbs,
                    'homeLink' => [
                        'label' => \rmrevin\yii\fontawesome\FA::i('dashboard').Yii::t('app', 'Home'),
                        'url' => ['/admin'],
                        'encode' => FALSE,
                    ],
                ]) ?>
            </section>

            <section class="content">
                <?= \dmstr\widgets\Alert::widget() ?>
                <?= $content ?>
            </section>
        </div>
    </div>
<?php
// AdminLTE 的一个调整高度的脚本
$this->registerJs("
$.AdminLTE.layout.activate();");
?>
<?php $this->endContent(); ?>