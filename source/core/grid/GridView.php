<?php

namespace source\core\grid;

use source\core\base\BaseView;
use yii\helpers\Html;

class GridView extends \yii\grid\GridView
{
    public $summary = NULL;
    public $dataColumnClass = 'source\core\grid\DataColumn';
    public $pager = ['class' => 'source\core\widgets\AdminLinkPager'];
    public $toolbar = [];

    public $tableOptions = ['class' => 'table table-hover'];
    public $layout = <<<EOF
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{summary}</h3>
        </div>
        <div class="box-body no-padding">
            <div class="col-md-12">{toolbar}</div>
            {items}
        </div>
        <div class="box-footer clearfix">
            {pager}
        </div>
    </div>
EOF;


    public function renderSection($name) {
        switch ($name) {
            case '{toolbar}':
                return $this->renderToolbar();
            default:
                return parent::renderSection($name);
        }
    }

    public function renderToolbar(){
        if(empty($this->toolbars)){
            /** @var FrontView $view */
            $view = $this->view;
            $this->toolbar = $view->toolbar;
        }

        $content = '';
        foreach ($this->toolbar as $item){
            $content .= $item;
        }
        return Html::tag('div', $content, ['class'=>'btn-group']);
    }


}