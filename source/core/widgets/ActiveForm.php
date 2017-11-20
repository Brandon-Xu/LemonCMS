<?php

namespace source\core\widgets;

use source\core\base\BaseView;
use yii\helpers\Html;

class ActiveForm extends \yii\bootstrap\ActiveForm
{

    public $buttons = [];

    public $fieldClass = 'source\core\widgets\ActiveField';

    public function init() {
        $this->options['role'] = isset($this->options['role']) ? $this->options['role'] : 'form';
        $this->options['class'] = isset($this->options['class']) ? $this->options['class'] . ' box' : 'box';


        /** @var FrontView $view */
        $view = $this->getView();
        $title = $view->title;

        parent::init();
        echo <<<EOF
        <div class="box-header">
            <h3 class="box-title">$title</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
EOF;
    }

    public function run() {
        if (empty($this->buttons)) {
            $this->buttons = [
                Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary pull-right']),
                Html::resetButton(\Yii::t('app', 'Reset'), ['class' => 'btn btn-default']),
            ];
        }
        $button = $this->renderButtons();

        echo <<<EOF
                </div>
            </div>
        </div>
        <div class="box-footer clearfix">
            $button
        </div>
EOF;
        parent::run();
    }

    /**
     * @return string
     */
    public function renderButtons(){
        $content = '';
        foreach ($this->buttons as $button){
            $content .= $button;
        }
        return $content;
    }

    /**
     * @inheritdoc
     * @return ActiveField|\yii\bootstrap\ActiveField
     */
    public function field($model, $attribute, $options = []) {
        return parent::field($model, $attribute, $options);
    }
}
