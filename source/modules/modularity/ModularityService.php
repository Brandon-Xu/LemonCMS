<?php

namespace source\modules\modularity;

use source\core\modularity\ModuleService;
use source\LuLu;
use source\modules\modularity\models\Modularity;
use yii\helpers\FileHelper;

class ModularityService extends ModuleService
{

    public function getServiceId() {
        return 'modularityService';
    }

    public function getActiveModules($isAdmin = FALSE) {
        $ret = [];

        $field = $isAdmin ? 'enable_admin' : 'enable_home';
        $allModules = Modularity::find()->where([
            $field => 1,
        ])->indexBy('id')->all();

        $modules = $this->loadAllModules();
        foreach ($modules as $m) {
            $moduleId = $m['id'];

            if (array_key_exists($moduleId, $allModules)) {
                $ret[$moduleId]['id'] = $m['id'];
                $ret[$moduleId]['dir'] = $m['dir'];
                $ret[$moduleId]['dir_class'] = $m['dir_class'];
                $ret[$moduleId]['class'] = $m['class'];
                $ret[$moduleId]['instance'] = $m['instance'];
            }
        }

        return $ret;
    }

    public function getAllModules() {
        $ret = [];

        $allModules = Modularity::find()->indexBy('id')->all();

        $modules = $this->loadAllModules();
        foreach ($modules as $m) {
            $moduleId = $m['id'];

            $ret[$moduleId] = $m;
            if (array_key_exists($moduleId, $allModules)) {
                $exitModule = $allModules[$moduleId];

                if ($ret[$moduleId]['has_admin']) {
                    $ret[$moduleId]['can_active_admin'] = ($exitModule['enable_admin'] === NULL || $exitModule['enable_admin'] === 0) ? TRUE : FALSE;
                }
                if ($ret[$moduleId]['has_home']) {
                    $ret[$moduleId]['can_active_home'] = ($exitModule['enable_home'] === NULL || $exitModule['enable_home'] === 0) ? TRUE : FALSE;
                }

                $ret[$moduleId]['can_install'] = FALSE;
                $ret[$moduleId]['can_uninstall'] = ($ret[$moduleId]['has_admin'] && $exitModule['enable_admin'] || $ret[$moduleId]['has_home'] && $exitModule['enable_home']) ? FALSE : TRUE;
            }
        }

        return $ret;
    }

    private $allModules = NULL;

    private function loadAllModules() {
        if ($this->allModules !== NULL) {
            return $this->allModules;
        }
        $this->allModules = [];

        $moduleRootPath = LuLu::getAlias('@source').'/modules';

        if ($moduleRootDir = @ dir($moduleRootPath)) {
            while (($moduleFolder = $moduleRootDir->read()) !== FALSE) {
                $currentModuleDir = $moduleRootPath.'/'.$moduleFolder;
                if (preg_match('|^\.+$|', $moduleFolder) || !is_dir($currentModuleDir)) {
                    continue;
                }

                $moduleClassName = ucwords($moduleFolder);

                if (FileHelper::exist($currentModuleDir.'/'.$moduleClassName.'Info.php')) {
                    $class = 'source\modules\\'.$moduleFolder.'\\'.$moduleClassName.'Info';
                } else {
                    continue;
                }

                $instance = NULL;
                try {
                    // $moduleObj = LuLu::createObject($class);
                    $instance = new $class();
                    if (empty($instance->id)) {
                        $instance->id = $moduleFolder;
                    }
                    if (empty($instance->name)) {
                        $instance->name = $moduleFolder;
                    }
                } catch (Exception $e) {
                    $instance = NULL;
                }

                if ($instance !== NULL) {
                    $has_admin = FileHelper::exist($currentModuleDir.'/admin/AdminModule.php') ? TRUE : FALSE;
                    $has_home = FileHelper::exist($currentModuleDir.'/home/HomeModule.php') ? TRUE : FALSE;

                    $this->allModules[$instance->id] = [
                        'id' => $instance->id, 'dir' => $moduleFolder, 'dir_class' => $moduleClassName,
                        'class' => $class, 'instance' => $instance, 'can_install' => TRUE, 'can_uninstall' => TRUE,
                        'has_admin' => $has_admin, 'has_home' => $has_home, 'can_active_admin' => FALSE,
                        'can_active_home' => FALSE,
                    ];
                }
            }
        }

        return $this->allModules;
    }
}
