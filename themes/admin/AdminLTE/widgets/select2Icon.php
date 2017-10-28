<?php
/**
 * User: BrandonXu
 * Date: 2017/10/8
 * Time: 14:09
 */

namespace themes\admin\AdminLTE\widgets;

use yii\base\Model;
use yii\bootstrap\Widget;
use yii\helpers\Html;

class select2Icon extends Widget
{
    /** @var Model $model */
    public $model;
    public $attribute;

    public function run() {
        app()->view->registerJs("
        function formatState(state){
            var \$state = $(\"<i class='fa fa-\"+state.text+\"'> \"+state.text+\"</i>\");
            return \$state;
        };
        jQuery(\".select2\").select2({
            templateResult: formatState,
            templateSelection: formatState
        });
        ");

        $p = new \ReflectionClass('rmrevin\yii\fontawesome\FontAwesome');
        $c = new \ReflectionClass('rmrevin\yii\fontawesome\FA');
        $icons = [];
        foreach ($c->getConstants() as $key => $icon) {
            if (!$p->hasConstant($key)) {
                $icons["<i class=\"fa fa-{$icon}\"></i>"] = $icon;
            }
        }

        return Html::tag('div', Html::activeDropDownList(
            $this->model,
            $this->attribute, $icons,
            ['class' => 'select2']
        ), ['style'=>'width: 100%;']);
    }

}