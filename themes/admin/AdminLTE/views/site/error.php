<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div id="da-error-wrapper">
    <h1 class="da-error-heading"><?= $message ?></h1>
    <p><a href="<?php echo app()->request->getReferrer() ?>">返回上一页</a></p>
</div>