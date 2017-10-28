<?php

namespace source\core\grid;

use source\libs\Constants;

class StatusColumn extends DataColumn
{

    public $attribute = 'status';

    public function init() {
        parent::init();
        $this->contentOptions = ['class' => 'align-center'];
        $this->content = function ($model, $key, $index, $gridView) {
            return Constants::getStatusItems($model->status);
        };
    }
}