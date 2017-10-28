<?php

namespace source\core\grid;

class DateTimeColumn extends DataColumn
{
    public $headerOptions = ['width' => '150px'];

    public $format = [
        'datetime', 'php:Y-m-d H:m:s',
    ];

    public function init() {
        parent::init();
    }
}