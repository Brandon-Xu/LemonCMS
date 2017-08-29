<?php

namespace source\core\base;

use yii\base\Object;

class ActionResult extends Object
{

    public $controller;

    public $action;

    public $isExecuted = FALSE;

    public $result;

    public function __toString() {
        return $this->result;
    }
}

