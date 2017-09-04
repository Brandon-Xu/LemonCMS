<?php

namespace source\core\modularity;

use source\core\base\BaseComponent;

abstract class ModuleService extends BaseComponent implements IModuleService
{
    public abstract function getServiceId();

    public function getModel($name) { }

    public function getClassName(){
        return ucfirst($this->getServiceId());
    }
}
