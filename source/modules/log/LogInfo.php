<?php

namespace source\modules\log;

class LogInfo extends \source\core\modularity\ModuleInfo
{

    public function init() {
        parent::init();

        $this->id = 'log';
        $this->name = '日志模块';
        $this->version = '1.0';
        $this->description = '日志模块';

        $this->is_system = TRUE;
    }
}
