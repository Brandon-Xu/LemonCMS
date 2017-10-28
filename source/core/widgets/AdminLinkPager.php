<?php

namespace source\core\widgets;

use yii\helpers\Html;

class AdminLinkPager extends LinkPager
{

    public function init() {
        parent::init();

        $this->options = ['class' => 'pagination pagination-sm no-margin pull-right'];
        $this->linkOptions = [];

        $this->activePageCssClass = 'active';
        $this->disabledPageCssClass = 'disabled';
    }

    protected function renderPageButtons() {
        $buttons = $this->getButtonItems();
        if ($buttons === '') {
            return '';
        }

        return Html::tag('ul', implode("\n", $buttons), $this->options);
    }

    protected function renderPageButton($label, $page, $class, $disabled, $active) {
        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        if ($class !== '') {
            Html::addCssClass($linkOptions, $class);
        }
        if ($disabled) {
            Html::addCssClass($linkOptions, $this->disabledPageCssClass);
        }
        if ($active) {
            Html::addCssClass($linkOptions, $this->activePageCssClass);
        }

        $url = $disabled ? 'javascript:void;' : $this->pagination->createUrl($page);
        $link = Html::a($label, $url);
        return Html::tag('li', $link, $linkOptions);
    }

}
