<?php

namespace source\core\grid;

use source\libs\Constants;

class TargetColumn extends DataColumn
{

    public $attribute = 'target';

    public function init() {
        parent::init();
        $this->contentOptions = ['class' => 'align-center', 'width'=>'80px'];
        $this->content = function ($model, $key, $index, $gridView) {
            return Constants::getTargetItems($model->target);
        };
    }
}