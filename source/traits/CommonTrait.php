<?php

namespace source\traits;

use source\core\modularity\ModuleService;
use source\libs\Common;
use source\LuLu;
use yii\base\InvalidParamException;

/**
 * @property \source\modules\modularity\ModularityService $modularity
 * @property \source\modules\modularity\ModularityService $modularityService
 * @property \source\modules\rbac\RbacService $rbacService
 * @property \source\modules\taxonomy\TaxonomyService $taxonomyService
 * @property \source\modules\menu\MenuService $menuService
 *
 */
trait  CommonTrait
{
    public function __get($name) {
        $dot = strpos($name, 'Service');
        if ($dot > 0) {
            $serviceName = substr($name, 0, $dot);

            $id = $serviceName.'Service';
            $component = app()->get($id, TRUE);
            if ($component instanceof ModuleService) {
                return $component;
            }
            throw new InvalidParamException("get service:$id");
        }
        return parent::__get($name);
    }

    public function getModularity(){
        return app()->get('modularityService', TRUE);
    }

    public function getConfig($id) {
        return Common::getConfig($id);
    }

    public function getConfigValue($id) {
        return Common::getConfigValue($id);
    }

    public function showConfigValue($id) {
        $value = self::getConfigValue($id);
        if (!empty($value)) {
            echo $value;
        }
    }
}



