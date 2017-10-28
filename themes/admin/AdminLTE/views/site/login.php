<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this \source\core\front\FrontView */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model source\models\LoginForm */
\themes\admin\dandelion\LoginAsset::register($this);
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
        <title>登录——LuLu CMS 管理中心</title>
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody(); ?>

    <div id="da-login">
        <div id="da-login-box-wrapper">
            <div id="da-login-top-shadow">
            </div>
            <div id="da-login-box">
                <div id="da-login-box-header">
                    <h1>Login</h1>
                </div>
                <div id="da-login-box-content">
                    <?php $form = ActiveForm::begin(['id' => 'da-login-form']); ?>
                    <div id="da-login-input-wrapper">
                        <div class="da-login-input">
                            <?php echo Html::activeTextInput($model, 'username', [
                                'id' => 'da-login-username',
                                'placeholder' => 'Username',
                            ]) ?>
                        </div>
                        <div class="da-login-input">
                            <?php echo Html::activePasswordInput($model, 'password', [
                                'id' => 'da-login-password',
                                'placeholder' => 'Password',
                            ]) ?>
                        </div>
                    </div>
                    <div id="da-login-button">
                        <input type="submit" value="Login" id="da-login-submit"/>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                <div id="da-login-box-footer">
                    <?php if (!empty($message)) {
                        echo $message.'<br>';
                    } ?>
                    <a href="#">demo/demo</a>
                    <div id="da-login-tape"></div>
                </div>
            </div>
            <div id="da-login-bottom-shadow">
            </div>
        </div>
    </div>
    <?php $this->endBody(); ?>
    </body>
    </html>

<?php $this->endPage(); ?>