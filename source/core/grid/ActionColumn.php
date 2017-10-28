<?php

namespace source\core\grid;

use rmrevin\yii\fontawesome\FA;
use source\libs\Resource;
use source\assets\AdminIconAssets;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * ActiveField represents a form input field within an [[ActiveForm]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ActionColumn extends \yii\grid\ActionColumn
{

    public $header = 'Actions';
    public $queryParams = [];

    public $width = '100px';

    public $template = '{update} {delete}';

    public $assets;

    public function init() {
        parent::init();
        if (!isset($this->headerOptions['width'])) {
            $this->headerOptions['width'] = $this->width;
        }
        $this->header = Yii::t('app', $this->header);
        $this->contentOptions = [
            'class' => 'icon-column',
            'style' => "width:{$this->width};",
        ];

        app()->view->registerCss("
            .icon-column i.fa-eye { color:#0cc6eb; }\n
            .icon-column i.fa-pencil { color:#efbd18; }\n
            .icon-column i.fa-key { color:#efbd18; }\n
            .icon-column i.fa-remove { color:#e33333; }\n
            .icon-column i.fa-trash-o { color:#e33333; }\n
            .action-column, \n
            .icon-column { text-align: center; }\n
        ", [], 'actionColumnClassCss');
    }

        protected function initDefaultButtons() {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'pencil');
        $this->initDefaultButton('delete', 'trash-o', [
            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = []) {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    //'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = FA::i($iconName);
                return Html::a($icon, $url, $options);
            };
        }
    }

}