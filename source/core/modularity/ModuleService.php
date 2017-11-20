<?php

namespace source\core\modularity;

use yii\base\Component;

abstract class ModuleService extends Component implements IModuleService
{
    public abstract function getServiceId();

    public function getModel($name) { }

    public function getClassName(){
        return ucfirst($this->getServiceId());
    }
}
