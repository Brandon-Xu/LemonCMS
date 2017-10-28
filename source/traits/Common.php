<?php

namespace source\traits;

use source\models\Config;
use source\modules\files\FilesService;
use source\modules\i18n\models\Message;
use source\modules\menu\MenuService;
use source\modules\modularity\ModularityService;
use source\modules\rbac\RbacService;
use source\modules\taxonomy\TaxonomyService;

/**
 * @property ModularityService $modularity
 * @property RbacService $rbac
 * @property TaxonomyService $taxonomy
 * @property MenuService $menu
 * @property FilesService $files
 *
 */
trait Common
{

    /**
     * @return Config
     */
    public function config(){
        return new Config();
    }

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

    /**
     * @return null|FilesService
     */
    public function getFiles(){
        return app()->get('filesService', TRUE);
    }

    /**
     * @param $message
     * @param null $category
     * @param array $params
     * @param null $lang
     * @return string
     */
    public function t($message, $category = NULL, $params = [], $lang = NULL){
        return Message::t($message, $category, $params, $lang);
    }

}



