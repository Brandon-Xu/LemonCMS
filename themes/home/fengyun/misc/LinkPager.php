<?php

namespace themes\home\fengyun\misc;

use yii\helpers\Html;

class LinkPager extends \source\core\widgets\LinkPager
{

    public function init() {
        parent::init();
        $this->options = ['id' => 'pagenavi'];
        $this->linkOptions = ['class' => 'page-numbers'];
        $this->activePageCssClass = 'current';
    }

    protected function renderPageButtons() {
        $buttons = $this->getButtonItems();
        if ($buttons === '') { return ''; }

        return Html::tag('div', implode("\n", $buttons), $this->options);
    }

    protected function renderPageButton($label, $page, $class, $disabled, $active) {
        $options = ['class' => $class === '' ? NULL : $class];

        if ($disabled) {
            Html::addCssClass($options, $this->disabledPageCssClass);
            return Html::tag('span', $label);
        }

        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;
        if ($active) {
            Html::addCssClass($linkOptions, $this->activePageCssClass);
        }

        return Html::a($label, $this->pagination->createUrl($page), $linkOptions);
    }
}
