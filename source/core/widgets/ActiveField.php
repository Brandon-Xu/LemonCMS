<?php

namespace source\core\widgets;

use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\web\View;

class ActiveField extends \yii\bootstrap\ActiveField implements IBaseWidget
{

    public $options = [
        'class' => 'form-group',
    ];

    public function fileInput($options = []) {

        if ($this->inputOptions !== ['class' => 'form-control']) {
            $options = array_merge($this->inputOptions, $options);
        }
        $this->addAriaAttributes($options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = app()->files->fileInput($this->model, $this->attribute, $options);

        return $this;
    }

    public function dropDownList($items, $options = []) {
        if (!isset($options['placeholder'])){
            $options['placeholder'] = 'Select a state';
        }

        $this->parts['{input}'] = Select2::widget([
            'theme' => 'default',
            'model' => $this->model,
            'attribute' => $this->attribute,
            'data' => $items,
            'language' => 'en',
            'options' => $options,
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        return $this;
    }

    public function fontAwesomeList(){
        $cacheKey   = 'fontawesome_icons_list_7123u876asdbgh';
        $p          = new \ReflectionClass('rmrevin\yii\fontawesome\FontAwesome');

        $escape = new JsExpression("function(m) { return m; }");
        $format = <<< SCRIPT
        function select2FormatState(state){
            var \$state = $("<i class='fa fa-"+state.text+"'> "+state.text+"</i>");
            return \$state;
        };
SCRIPT;
        app()->getView()->registerJs($format, View::POS_HEAD);

        $cIcons = app()->cache->exists($cacheKey) ? app()->cache->get($cacheKey) : NULL;
        if($cIcons === NULL){
            $c = new \ReflectionClass('rmrevin\yii\fontawesome\FA');
            $cIcons = $c->getConstants();
            app()->cache->set($cacheKey, $cIcons);
        }
        $icons = [];
        foreach ($cIcons as $key => $icon) {
            if (!$p->hasConstant($key)) {
                $icons["<i class=\"fa fa-{$icon}\"></i>"] = $icon;
            }
        }

        $this->parts['{input}'] = Select2::widget([
            'theme'     => 'default',
            'model'     => $this->model,
            'attribute' => $this->attribute,
            'data'      => $icons,
            'language'  => 'en',
            'options'   => [],
            'pluginOptions' => [
                'templateResult' => new JsExpression('select2FormatState'),
                'templateSelection' => new JsExpression('select2FormatState'),
                'escapeMarkup' => $escape,
                'allowClear' => true
            ],
        ]);
        return $this;
    }
}