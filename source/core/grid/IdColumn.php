<?php

namespace source\core\grid;

class IdColumn extends DataColumn
{
    public $attribute = 'id';

    public function init() {
        parent::init();
    }
}