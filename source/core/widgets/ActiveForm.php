<?php

namespace source\core\widgets;

use source\core\front\FrontView;
use yii\helpers\Html;

class ActiveForm extends \yii\bootstrap\ActiveForm
{

    public $buttons = [];

    public $options = [
        'role' => 'form',
        'class' => 'row',
    ];

    public $fieldClass = 'source\core\widgets\ActiveField';

    public function init() {
        /** @var FrontView $view */
        $view = $this->getView();
        $title = $view->title;

        echo <<<EOF
        <div class="box">
        <div class="box-header">
            <h3 class="box-title">$title</h3>
        </div>
        <div class="box-body">
            <div class="col-md-12">
EOF;
        parent::init();
    }

    public function run() {
        if (empty($this->buttons)) {
            $this->buttons = [
                Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary pull-right']),
                Html::resetButton(\Yii::t('app', 'Reset'), ['class' => 'btn btn-default']),
            ];
        }
        $button = $this->renderButtons();

        parent::run();
        echo <<<EOF
            </div>
        </div>
        <div class="box-footer clearfix">
            $button
        </div>
    </div>
EOF;
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
