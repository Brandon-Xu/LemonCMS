<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace source\core\widgets;


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Response;

class Pjax extends \yii\widgets\Pjax
{

    private $_pjax_switch = TRUE;

    public $id;

    public $timeout = 2000;

    /**
     * @inheritdoc
     */
    public function init() {
        if (!$this->_pjax_switch) {
            return ;
        }

        if (!empty($this->id)) {
            $this->options['id'] = $this->id;
        }
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        if ($this->requiresPjax()) {
            ob_start();
            ob_implicit_flush(FALSE);
            $view = $this->getView();
            $view->clear();
            $view->beginPage();
            $view->head();
            $view->beginBody();
            if ($view->title !== NULL) {
                echo Html::tag('title', Html::encode($view->title));
            }
        } else {
            $options = $this->options;
            $tag = ArrayHelper::remove($options, 'tag', 'div');
            echo Html::beginTag($tag, array_merge([
                'data-pjax-container' => '',
                'data-pjax-push-state' => $this->enablePushState,
                'data-pjax-replace-state' => $this->enableReplaceState,
                'data-pjax-timeout' => $this->timeout,
                'data-pjax-scrollto' => $this->scrollTo,
            ], $options));
        }

        return ;
    }

    public function run() {
        if (!$this->_pjax_switch) {
            return ;
        }

        if (!$this->requiresPjax()) {
            echo Html::endTag(ArrayHelper::remove($this->options, 'tag', 'div'));
            $this->registerClientScript();

            return ;
        }

        $view = $this->getView();
        $view->endBody();

        // Do not re-send css files as it may override the css files that were loaded after them.
        // This is a temporary fix for https://github.com/yiisoft/yii2/issues/2310
        // It should be removed once pjax supports loading only missing css files
        //$view->cssFiles = null;

        $view->endPage(true);

        $content = ob_get_clean();

        // only need the content enclosed within this widget
        $response = \Yii::$app->getResponse();
        $response->clearOutputBuffers();
        $response->setStatusCode(200);
        $response->format = Response::FORMAT_HTML;
        $response->content = $content;
        $response->headers->setDefault('X-Pjax-Url', \Yii::$app->request->url);
        $response->send();

        \Yii::$app->end();

        return ;
    }

}
