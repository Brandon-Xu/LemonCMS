<?php

namespace source\traits;

use source\core\modularity\ModuleService;
use source\libs\Common;
use source\LuLu;
use source\modules\menu\MenuService;
use source\modules\modularity\ModularityService;
use source\modules\rbac\RbacService;
use source\modules\taxonomy\TaxonomyService;
use yii\base\InvalidParamException;

/**
 * @property ModularityService $modularity
 * @property RbacService $rbac
 * @property TaxonomyService $taxonomy
 * @property MenuService $menu
 *
 */
trait  CommonTrait
{

    /**
     * @return null|ModularityService
     */
    public function getModularity(){
        return app()->get('modularityService', TRUE);
    }

    /**
     * @return null|RbacService
     */
    public function getRbac(){
        return app()->get('rbacService', TRUE);
    }

    /**
     * @return null|TaxonomyService
     */
    public function getTaxonomy(){
        return app()->get('taxonomyService', TRUE);
    }

    /**
     * @return null|MenuService
     */
    public function getMenu(){
        return app()->get('menuService', TRUE);
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



